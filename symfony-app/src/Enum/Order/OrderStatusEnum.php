<?php

declare(strict_types=1);

namespace App\Enum\Order;

enum OrderStatusEnum: string
{
    public const PLACED_VALUE = 'PLACED';
    public const PROCESSING_VALUE = 'PROCESSING';
    public const SHIPPED_VALUE = 'SHIPPED';
    public const DELIVERED_VALUE = 'DELIVERED';
    public const CANCELED_VALUE = 'CANCELED';

    case PLACED = self::PLACED_VALUE;
    case PROCESSING = self::PROCESSING_VALUE;
    case SHIPPED = self::SHIPPED_VALUE;
    case DELIVERED = self::DELIVERED_VALUE;
    case CANCELED = self::CANCELED_VALUE;
}
