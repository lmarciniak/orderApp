<?php

declare(strict_types=1);

namespace App\Service\Order\Calculator;

use App\Entity\Order;

interface OrderAmountCalculatorInterface
{
    /**
     * @param Order $order
     * @return float
     */
    public function calculate(Order $order): float;
}
