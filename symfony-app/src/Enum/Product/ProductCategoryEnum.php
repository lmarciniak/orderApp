<?php

declare(strict_types=1);

namespace App\Enum\Product;

enum ProductCategoryEnum: string
{
    public const ELECTRONICS_VALUE = 'ELECTRONICS';
    public const FASHION_VALUE = 'FASHION';
    public const HOME_AND_GARDEN_VALUE = 'HOME_AND_GARDEN';
    public const HEALTH_AND_BEAUTY_VALUE = 'HEALTH_AND_BEAUTY';
    public const SPORTS_AND_OUTDOORS_VALUE = 'SPORTS_AND_OUTDOORS';
    public const TOYS_AND_GAMES_VALUE = 'TOYS_AND_GAMES';
    public const AUTOMOTIVE_VALUE = 'AUTOMOTIVE';
    public const BOOKS_AND_MEDIA_VALUE = 'BOOKS_AND_MEDIA';
    public const GROCERIES_VALUE = 'GROCERIES';
    public const PET_SUPPLIES_VALUE = 'PET_SUPPLIES';
    public const OFFICE_SUPPLIES_VALUE = 'OFFICE_SUPPLIES';

    case ELECTRONICS = self::ELECTRONICS_VALUE;
    case FASHION = self::FASHION_VALUE;
    case HOME_AND_GARDEN = self::HOME_AND_GARDEN_VALUE;
    case HEALTH_AND_BEAUTY = self::HEALTH_AND_BEAUTY_VALUE;
    case SPORTS_AND_OUTDOORS = self::SPORTS_AND_OUTDOORS_VALUE;
    case TOYS_AND_GAMES = self::TOYS_AND_GAMES_VALUE;
    case AUTOMOTIVE = self::AUTOMOTIVE_VALUE;
    case BOOKS_AND_MEDIA = self::BOOKS_AND_MEDIA_VALUE;
    case GROCERIES = self::GROCERIES_VALUE;
    case PET_SUPPLIES = self::PET_SUPPLIES_VALUE;
    case OFFICE_SUPPLIES = self::OFFICE_SUPPLIES_VALUE;
}
