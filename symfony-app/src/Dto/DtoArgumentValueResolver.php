<?php

declare(strict_types=1);

namespace App\Dto;


use ReflectionException;
use ReflectionProperty;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class DtoArgumentValueResolver implements ValueResolverInterface
{
    /**
     * @throws ReflectionException
     */
    #[\Override] public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $dto = new ($argument->getType());
        $requestParams = json_decode($request->getContent(), true);
        foreach (get_class_vars($argument->getType()) as $property => $defaultValue) {
            $reflectionProperty = new ReflectionProperty($argument->getType(), $property);
            $reflectionProperty->setValue($dto, $requestParams[$property] ?? null);
        }

        yield $dto;
    }
}