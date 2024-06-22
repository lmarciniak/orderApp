<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator
{
    /**
     * @var ConstraintViolationListInterface|null
     */
    private ?ConstraintViolationListInterface $errors = null;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(private readonly ValidatorInterface $validator)
    {

    }

    /**
     * @param AbstractDto $dto
     * @return bool
     */
    public function validate(AbstractDto $dto): bool
    {
        $this->errors = $this->validator->validate($dto);

        return $this->errors->count() <= 0;
    }

    /**
     * @return ConstraintViolationListInterface|null
     */
    public function getErrors(): ?ConstraintViolationListInterface
    {
        return $this->errors;
    }
}