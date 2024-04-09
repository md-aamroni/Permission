<?php

namespace Aamroni\Permission\Exceptions;

use Exception;

class PermissionDecodeException extends Exception
{
    /**
     * The error message
     * @var string
     */
    protected $message = 'Error occurred during decode permission';
}
