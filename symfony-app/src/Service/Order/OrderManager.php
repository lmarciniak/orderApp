<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Dto\Request\Order\SaveOrderDto;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Enum\Order\OrderStatusEnum;
use App\Service\Order\Calculator\OrderAmountCalculatorCollector;
use App\Service\Product\ProductLoader;
use Doctrine\ORM\EntityManagerInterface;

class OrderManager
{
    public function __construct(
        protected readonly EntityManagerInterface         $entityManager,
        protected readonly ProductLoader                  $productLoader,
        protected readonly OrderAmountCalculatorCollector $netAmountCalculatorCollector,
        protected readonly OrderAmountCalculatorCollector $vatAmountCalculatorCollector,
        protected readonly OrderAmountCalculatorCollector $totalAmountCalculatorCollector
    )
    {
    }

    /**
     * @param array<SaveOrderDto> $saveOrderDtos
     * @return array<Order>
     */
    public function save(array $saveOrderDtos): array
    {
        $this->entityManager->beginTransaction();
        try {
            $orders = $this->createOrders($saveOrderDtos, $this->warmUpPersisitingContext($saveOrderDtos));
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $exception) {
            $this->entityManager->rollback();
            $orders = [];
        }

        return $orders;
    }

    /**
     * @param array<SaveOrderDto> $saveOrderDtos
     * @return array<Order>
     */
    protected function createOrders(array $saveOrderDtos, OrderPersistingContext $orderPersistingContext): array
    {
        $orders = [];
        $orderDate = new \DateTimeImmutable();
        foreach ($saveOrderDtos as $dto) {
            $order = (new Order())->setOrderDate($orderDate)
                ->setStatus(OrderStatusEnum::PLACED);
            foreach ($dto->orderItems as $orderItem) {
                $orderItem = (new OrderItem())
                    ->setProduct($orderPersistingContext->productById[$orderItem['productId']])
                    ->setQuantity($orderItem['quantity']);
                $this->entityManager->persist($orderItem);
                $order->addOrderItem($orderItem);
            }
            $order->setNetAmount($this->netAmountCalculatorCollector->calculate($order))
                ->setVatAmount($this->vatAmountCalculatorCollector->calculate($order))
                ->setTotalAmount($this->totalAmountCalculatorCollector->calculate($order));
            $this->entityManager->persist($order);
            $orders[] = $order;
        }

        return $orders;
    }


    /**
     * @param array<SaveOrderDto> $saveOrderDtos
     * @return OrderPersistingContext
     */
    protected function warmUpPersisitingContext(array $saveOrderDtos): OrderPersistingContext
    {
        $context = new OrderPersistingContext();
        $context->productById = $this->productLoader->loadByIds(
            array_merge(
                ...array_map(
                    fn(SaveOrderDto $dto) => $dto->collectProductIds(),
                    $saveOrderDtos
                )
            )
        );

        return $context;
    }
}