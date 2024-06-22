<?php

declare(strict_types=1);

namespace App\Service\Product;

use App\Entity\Product;
use App\Repository\ProductRepository;

class ProductLoader
{
    public function __construct(protected readonly ProductRepository $productRepository)
    {

    }

    /**
     * @param array $ids
     * @return array<Product>
     */
    public function loadByIds(array $ids): array
    {
        $result = [];
        $products = $this->productRepository->findBy(['id' => $ids]);
        foreach ($products as $oneProduct) {
            $result[$oneProduct->getId()] = $oneProduct;
        }

        return $result;
    }
}