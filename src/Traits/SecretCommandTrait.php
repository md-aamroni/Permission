<?php

namespace Aamroni\Permission\Traits;

use Illuminate\Support\Str;

trait SecretCommandTrait
{
    /**
     * Get the random secret string
     * @return string
     */
    private function getSecret(): string
    {
        return Str::random(length: 64);
    }

    /**
     * Get the dot env file path
     * @return string
     */
    private function getDotEnv(): string
    {
        return $this->laravel->basePath(path: '.env');
    }

    /**
     * Create or update the existing JWT secret
     * @return void
     */
    protected function createOrUpdateJsonWebTokenSecret(): void
    {
        if (Str::contains(haystack: file_get_contents($this->getDotEnv()), needles: 'PERMISSION_SECRET') === false) {
            file_put_contents(filename: $this->getDotEnv(), data: PHP_EOL.'PERMISSION_SECRET='.$this->getSecret().PHP_EOL, flags: FILE_APPEND);
        } else {
            $this->skipGenerateIfTheOptionIsDefined();
            $this->isConfirmToReplaceExistingSecret();
            $this->updateTheCurrentDotEnvFileSecret();
        }
    }

    /**
     * Get the current generated auth secret
     * @return void
     */
    protected function displayTheCurrentGeneratedSecret(): void
    {
        if ($this->option(key: 'show')) {
            $this->comment(string: $this->getSecret());
        }
    }

    /**
     * Check whether the secret is existed or not
     * @return void
     */
    protected function checkWhetherSecretIsExistedOrNot(): void
    {
        if (file_exists(filename: $this->getDotEnv()) === false) {
            $this->shouldDisplayTheStoredAuthSecret();
        }
    }

    /**
     * Display the secret key
     * @return void
     */
    protected function shouldDisplayTheStoredAuthSecret(): void
    {
        $this->laravel['config']['permission.secret'] = $this->getSecret();
        $this->info(string: sprintf('JWT auth signature [%s] set successfully.', $this->getSecret()));
    }

    /**
     * Update the existing env
     * @return void
     */
    private function updateTheCurrentDotEnvFileSecret(): void
    {
        file_put_contents($this->getDotEnv(), str_replace(
            search:     'PERMISSION_SECRET='.$this->laravel['config']['permission.secret'],
            replace:    'PERMISSION_SECRET='.$this->getSecret(),
            subject:    file_get_contents($this->getDotEnv())
        ));
    }

    /**
     * Check if the modification is confirmed
     * @return void
     */
    private function isConfirmToReplaceExistingSecret(): void
    {
        $question = 'This will invalidate all existing tokens. Are you sure you want to override the secret key?';
        if ($this->option(key: 'force') || $this->confirm(question: $question) === false) {
            $this->comment(string: 'No changes were made to your secret key');
        }
    }

    /**
     * Skipping the auth secret generate based on option
     * @return void
     */
    private function skipGenerateIfTheOptionIsDefined(): void
    {
        if ($this->option(key: 'always-no')) {
            $this->comment(string: 'Oops! Secret key already existed');
        }
    }
}
