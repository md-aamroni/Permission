<?php

namespace Aamroni\Permission\Facades;

use Aamroni\Permission\PermissionManager;
use Illuminate\Support\Facades\Facade;
use stdClass;

/**
 * @method static string|array   encode(?string $subject = null, ?string $audience = null)
 * @method static stdClass|array decode(string $jwtToken, ?string $filename = null)
 */
class Permission extends Facade
{
    /**
     * Get the signature facade instance
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return PermissionManager::class;
    }
}
