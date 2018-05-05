<?php

namespace Scheduler\App\Exceptions;

use Exception;

class DBTransactionException extends Exception
{
    public function __construct($message, $code = 500)
    {
        parent::__construct($message, $code);
    }
}
