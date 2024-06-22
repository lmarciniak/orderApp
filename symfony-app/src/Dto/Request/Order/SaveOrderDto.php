<?php

declare(strict_types=1);

namespace App\Dto\Request\Order;

use App\Dto\AbstractDto;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;

class SaveOrderDto extends AbstractDto
{
    #[Assert\All(
       new Assert\Collection([
           'productId' => [
               new Assert\NotBlank(),
               new Assert\Type(Types::INTEGER),
               new Assert\Positive(message: 'Product id has to be greater than 0.')
           ],
           'quantity' => [
               new Assert\NotBlank(),
               new Assert\Type(Types::INTEGER),
               new Assert\Positive(message: 'Product quantity has to be greater than 0.')
           ]
       ])
    )]
    public ?array $orderItems = null;

    /**
     * @return array
     */
    public function collectProductIds(): array
    {
        $ids = [];
        foreach ($this->orderItems as $orderItem) {
            $ids[] = $orderItem['productId'];
        }

        return array_unique($ids);
    }
}