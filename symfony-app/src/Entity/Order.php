<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\Order\OrderStatusEnum;
use App\Enum\Serialization\SerializationGroupEnum;
use App\Repository\OrderRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups([SerializationGroupEnum::RESPONSE_FULL_VALUE,])]
    private ?DateTimeImmutable $orderDate = null;

    #[ORM\Column(type: 'string', enumType: OrderStatusEnum::class)]
    #[Groups([SerializationGroupEnum::RESPONSE_FULL_VALUE])]
    private ?OrderStatusEnum $status = null;

    #[ORM\Column]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?float $vatAmount = null;

    #[ORM\Column]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?float $netAmount = null;

    #[ORM\Column]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?float $totalAmount = null;

    /**
     * @var Collection<int, OrderItem>
     */
    #[ORM\OneToMany(targetEntity: OrderItem::class, mappedBy: 'orderRef')]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE,
    ])]
    private Collection $orderItems;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getOrderDate(): ?DateTimeImmutable
    {
        return $this->orderDate;
    }

    /**
     * @param DateTimeImmutable $orderDate
     * @return self
     */
    public function setOrderDate(DateTimeImmutable $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return OrderStatusEnum|null
     */
    public function getStatus(): ?OrderStatusEnum
    {
        return $this->status;
    }

    /**
     * @param OrderStatusEnum $status
     * @return self
     */
    public function setStatus(OrderStatusEnum $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTotalAmount(): ?float
    {
        return $this->totalAmount;
    }

    /**
     * @param float $totalAmount
     * @return self
     */
    public function setTotalAmount(float $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getVatAmount(): ?float
    {
        return $this->vatAmount;
    }

    /**
     * @param float $vatAmount
     * @return self
     */
    public function setVatAmount(float $vatAmount): self
    {
        $this->vatAmount = $vatAmount;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getNetAmount(): ?float
    {
        return $this->netAmount;
    }

    /**
     * @param float $netAmount
     * @return self
     */
    public function setNetAmount(float $netAmount): self
    {
        $this->netAmount = $netAmount;

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    /**
     * @param OrderItem $orderItem
     * @return self
     */
    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setOrderRef($this);
        }

        return $this;
    }

    /**
     * @param OrderItem $orderItem
     * @return self
     */
    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getOrderRef() === $this) {
                $orderItem->setOrderRef(null);
            }
        }

        return $this;
    }
}
