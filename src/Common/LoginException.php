<?php

namespace App\Common;

use Exception;

class LoginException extends \Exception
{
    /** @var int */
    private $statusCode;

    public function __construct($statusCode, $message = "", $code = 0, Exception $previous = null)
    {
        $this->statusCode = $statusCode;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}