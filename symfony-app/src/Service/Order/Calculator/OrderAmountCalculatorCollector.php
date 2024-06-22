<?php

declare(strict_types=1);

namespace App\Service\Order\Calculator;

use App\Entity\Order;

class OrderAmountCalculatorCollector
{
    /**
     * @param iterable<OrderAmountCalculatorInterface> $calculators
     */
    public function __construct(protected readonly iterable $calculators)
    {

    }

    /**
     * @param Order $order
     * @return float
     */
    public function calculate(Order $order): float
    {
        $amount = 0.0;
        foreach ($this->calculators as $calculator) {
            $amount += $calculator->calculate($order);
        }

        return $amount;
    }
}