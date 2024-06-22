<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Request\Order\SaveOrderDto;
use App\Dto\Validator;
use App\Entity\Order;
use App\Enum\Serialization\SerializationGroupEnum;
use App\Service\Order\OrderManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;

#[Route('/order', name: 'app_order_')]
class OrderController extends AbstractApiController
{
    public function __construct(Validator $dtoValidator, protected readonly OrderManager $orderManager)
    {
        parent::__construct($dtoValidator);
    }

    #[Route(name: 'create', methods: ['POST'])]
    public function create(SaveOrderDto $saveOrderDto): JsonResponse
    {
        if (!$this->dtoValidator->validate($saveOrderDto)) {
            return $this->invalidInputDataResponse();
        }
        $orders = $this->orderManager->save([$saveOrderDto]);
        if (empty($orders)) {
            return $this->json([], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->json(
            $orders,
            Response::HTTP_OK,
            [],
            (new ObjectNormalizerContextBuilder())->withGroups([SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE])->toArray()
        );
    }

    #[Route(path: '/{id}', name: 'get', methods: ['GET'])]
    public function get(Order $order): JsonResponse
    {
        return $this->json(
            $order,
            Response::HTTP_OK,
            [],
            (new ObjectNormalizerContextBuilder())->withGroups([SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE])->toArray()
        );
    }
}
