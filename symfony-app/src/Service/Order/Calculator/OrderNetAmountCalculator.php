<?php

declare(strict_types=1);

namespace App\Service\Order\Calculator;

use App\Entity\Order;

class OrderNetAmountCalculator implements OrderAmountCalculatorInterface
{
    /**
     * @param Order $order
     * @return float
     */
    public function calculate(Order $order): float
    {
        $netAmount = 0.0;
        foreach ($order->getOrderItems() as $orderItem) {
            $netAmount += $orderItem->getProduct()->getPrice() * $orderItem->getQuantity();
        }

        return $netAmount;
    }
}
