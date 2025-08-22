<?php

namespace App\Modules\Users\Domain\Exceptions;

use App\Shared\Domain\Exceptions\DomainException;

class Exceptions extends DomainException
{

    protected int $httpStatus = 404;
    protected string $statusCode = 'internal_error';

    /**
     * Constructor for NotImplementedException.
     *
     * @param string $message The error message.
     */
    public function __construct(string $message = "Internal Error") {
        parent::__construct($message);
    }

}