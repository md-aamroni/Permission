<?php

namespace Aamroni\Permission\Traits;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Process;

trait AlgoRsCommandTrait
{
    /**
     * Get the storage directory
     * @return string
     */
    private function getDirectory(): string
    {
        return storage_path(path: 'permission');
    }

    /**
     * Get the pem key files name
     * @return string[]
     */
    private function getKeyFiles(): array
    {
        return ['private.pem', 'public.pem'];
    }

    /**
     * Get the config secret
     * @return mixed
     */
    private function getSignature(): mixed
    {
        return $this->laravel['config']['permission.secret'];
    }

    /**
     * Create a new public and private encryption keys
     * @return void
     */
    protected function openSSLEncryptionShellExec(): void
    {
        Process::run(sprintf('openssl genrsa -passout pass:%s -out storage/permission/private.pem -aes256 4096', $this->getSignature()));
        Process::run(sprintf('openssl rsa -passin pass:%s -pubout -in storage/permission/private.pem -out storage/permission/public.pem', $this->getSignature()));
    }

    /**
     * Check whether required files are existed or not
     * @return void
     */
    protected function checkIsDirectoryExistOrNot(): void
    {
        $fileSystem = new Filesystem();
        if (! $fileSystem->isDirectory($this->getDirectory())) {
            $fileSystem->makeDirectory(path: $this->getDirectory());
        }
    }

    /**
     * Create public and private pem file
     * @return void
     */
    protected function createPublicAndPrivateFile(): void
    {
        $fileSystem = new Filesystem();
        foreach ($this->getKeyFiles() as $each) {
            $filePath = $this->getDirectory().DIRECTORY_SEPARATOR.$each;
            if (! $fileSystem->isFile(file: $filePath)) {
                $fileSystem->put(path: $filePath, contents: '');
            }
        }
    }
}
