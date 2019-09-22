<?php

namespace App\Api\Exception;

class RequestException extends \Exception
{
    protected $message = 'Cannot handle current request.';
}
