<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\Serialization\SerializationGroupEnum;
use App\Repository\OrderItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: OrderItemRepository::class)]
class OrderItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?Order $orderRef = null;

    #[ORM\ManyToOne(inversedBy: 'orderItems')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?Product $product = null;

    #[ORM\Column]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?int $quantity = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Order|null
     */
    public function getOrderRef(): ?Order
    {
        return $this->orderRef;
    }

    /**
     * @param Order|null $orderRef
     * @return self
     */
    public function setOrderRef(?Order $orderRef): self
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     * @return self
     */
    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return self
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
