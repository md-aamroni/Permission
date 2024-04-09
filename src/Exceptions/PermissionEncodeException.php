<?php

namespace Aamroni\Permission\Exceptions;

use Exception;

class PermissionEncodeException extends Exception
{
    /**
     * The error message
     * @var string
     */
    protected $message = 'Error occurred during encode permission';
}
