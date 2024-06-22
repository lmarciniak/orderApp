<?php

declare(strict_types=1);

namespace App\Enum\Serialization;

enum SerializationGroupEnum: string
{
    public const RESPONSE_FULL_VALUE = 'RESPONSE_FULL';

    public const RESPONSE_MAIN_FIELDS_VALUE = 'RESPONSE_MAIN_FIELDS';

    case RESPONSE_FULL = self::RESPONSE_FULL_VALUE;

    case RESPONSE_MAIN_FIELDS = self::RESPONSE_MAIN_FIELDS_VALUE;
}
