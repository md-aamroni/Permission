<?php

namespace Aamroni\Permission;

use Aamroni\Permission\Adapters\PermissionAdapter;
use Aamroni\Permission\Exceptions\PermissionDecodeException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use OpenSSLAsymmetricKey;
use stdClass;
use Throwable;

readonly class PermissionManager extends PermissionAdapter
{
    /**
     * Encode JWT outgoing payload
     * @param  string|null  $subject
     * @param  string|null  $audience
     * @return string|array
     */
    public function encode(?string $subject = null, ?string $audience = null): string|array
    {
        try {
            $pemFile = file_get_contents(filename: config(key: 'permission.keys.private'));
            $private = openssl_pkey_get_private(private_key: $pemFile, passphrase: env(key: 'PERMISSION_SECRET'));
            if (! isset($private) && ! $private instanceof OpenSSLAsymmetricKey) {
                throw new PermissionDecodeException();
            }
            $payload = array_merge_recursive(config(key: 'permission.payload'), ['aud' => $audience ?? env(key: 'APP_URL'), 'sub' => $subject]);

            return JWT::encode(payload: $payload, key: $private, alg: 'RS256');
        } catch (Throwable $throwable) {
            return ['error' => $throwable->getMessage()];
        }
    }

    /**
     * Decode JWT incoming payload
     * @param  string         $jwtToken
     * @param  string|null    $filename
     * @return stdClass|array
     */
    public function decode(string $jwtToken, ?string $filename = null): stdClass|array
    {
        try {
            $isSetPem = $filename ?? storage_path(path: 'permission/public.pem');
            $filePath = file_get_contents(filename: $isSetPem);
            if (! isset($filePath) && ! is_string($filePath)) {
                throw new PermissionDecodeException();
            }

            return JWT::decode(jwt: $jwtToken, keyOrKeyArray: new Key(keyMaterial: $filePath, algorithm: 'RS256'));
        } catch (Throwable $throwable) {
            return ['error' => $throwable->getMessage()];
        }
    }
}
