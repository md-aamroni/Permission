<?php

namespace Aamroni\Permission\Adapters;

use Aamroni\Permission\Interfaces\PermissionInterface;

abstract readonly class PermissionAdapter implements PermissionInterface
{
    /**
     * Create a new object instance
     * @return void
     */
    final public function __construct()
    {
        // TODO: Skip Code Here...
    }

    /**
     * Get a static signature instance
     * @return static
     */
    public static function instance(): static
    {
        return new static();
    }

    /**
     * Prevent invoking inaccessible methods in an object context
     * @return string
     */
    final public function __call(string $name, array $args)
    {
        return sprintf('Oops! unable to access %s class %s() method', __CLASS__, $name);
    }

    /**
     * Prevent invoking inaccessible methods in a static context
     * @return string
     */
    final public static function __callStatic(string $name, array $args)
    {
        return sprintf('Oops! unable to access %s class %s() static method', __CLASS__, $name);
    }
}
