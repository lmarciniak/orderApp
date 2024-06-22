<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Enum\Product\ProductCategoryEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $product = (new Product())->setName("Product {$i}")
                ->setPrice(100 + $i * 10)
                ->setCategory(ProductCategoryEnum::ELECTRONICS)
                ->setDescription("Product ({$i}) generated for testing purposes");
            $manager->persist($product);
        }

        $manager->flush();
    }
}
