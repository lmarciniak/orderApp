<?php

declare(strict_types=1);

namespace App\Service\Order\Calculator;

use App\Entity\Order;

class OrderVatAmountCalculator implements OrderAmountCalculatorInterface
{
    public const VAT_RATE = 0.23;

    /**
     * @param Order $order
     * @return float
     */
    public function calculate(Order $order): float
    {
        $vatAmount = 0.0;
        foreach ($order->getOrderItems() as $orderItem) {
            $vatAmount += $orderItem->getProduct()->getPrice() * self::VAT_RATE;
        }

        return $vatAmount;
    }
}
