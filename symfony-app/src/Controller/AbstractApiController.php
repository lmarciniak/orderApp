<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;

abstract class AbstractApiController extends AbstractController
{
    public function __construct(protected readonly Validator $dtoValidator)
    {
    }

    /**
     * @return JsonResponse
     */
    protected function invalidInputDataResponse(): JsonResponse
    {
        $inputErrors = [];
        /** @var ConstraintViolation $error */
        foreach ($this->dtoValidator->getErrors() as $error) {
            $inputErrors[$error->getPropertyPath()] = $error->getMessage();
        }

        return $this->json($inputErrors, Response::HTTP_BAD_REQUEST);
    }
}