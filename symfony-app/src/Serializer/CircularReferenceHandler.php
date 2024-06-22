<?php

declare(strict_types=1);

namespace App\Serializer;

class CircularReferenceHandler
{
    /**
     * @param $object
     * @return string|null
     */
    public function __invoke($object): ?string
    {
        return (string)$object->getId();
    }
}