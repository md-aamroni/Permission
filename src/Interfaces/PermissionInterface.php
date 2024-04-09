<?php

namespace Aamroni\Permission\Interfaces;

use stdClass;

interface PermissionInterface
{
    /**
     * Encode JWT outgoing payload
     * @param  string|null  $subject
     * @param  string|null  $audience
     * @return string|array
     */
    public function encode(?string $subject = null, ?string $audience = null): string|array;

    /**
     * Decode JWT incoming payload
     * @param  string         $jwtToken
     * @param  string|null    $filename
     * @return stdClass|array
     */
    public function decode(string $jwtToken, ?string $filename = null): stdClass|array;
}
