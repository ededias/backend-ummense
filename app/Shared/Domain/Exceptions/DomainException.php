<?php

namespace  App\Shared\Domain\Exceptions;

use Exception;

class DomainException extends Exception
{

    protected int $httpStatus = 422;

    protected string $statusCode = 'domain_exception';

    public function getStatus(): int
    {
        return $this->httpStatus;
    }

    public function getStatusCode(): string
    {
        return $this->statusCode;
    }
}
