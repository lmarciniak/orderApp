<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\Product\ProductCategoryEnum;
use App\Enum\Serialization\SerializationGroupEnum;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?string $name = null;

    #[ORM\Column(enumType: ProductCategoryEnum::class)]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?ProductCategoryEnum $category = null;

    #[ORM\Column]
    #[Groups([
        SerializationGroupEnum::RESPONSE_FULL_VALUE,
        SerializationGroupEnum::RESPONSE_MAIN_FIELDS_VALUE
    ])]
    private ?float $price = null;

    #[ORM\Column(length: 2000, nullable: true)]
    #[Groups([SerializationGroupEnum::RESPONSE_FULL_VALUE,])]
    private ?string $description = null;

    /**
     * @var Collection<int, OrderItem>
     */
    #[ORM\OneToMany(targetEntity: OrderItem::class, mappedBy: 'product')]
    private Collection $orderItems;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ProductCategoryEnum|null
     */
    public function getCategory(): ?ProductCategoryEnum
    {
        return $this->category;
    }

    /**
     * @param ProductCategoryEnum $category
     * @return self
     */
    public function setCategory(ProductCategoryEnum $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $orderItem->setProduct($this);
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
            if ($orderItem->getProduct() === $this) {
                $orderItem->setProduct(null);
            }
        }

        return $this;
    }
}
