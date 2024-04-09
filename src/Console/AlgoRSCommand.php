<?php

namespace Aamroni\Permission\Console;

use Aamroni\Permission\Traits\AlgoRsCommandTrait;
use Illuminate\Console\Command;

class AlgoRSCommand extends Command
{
    use AlgoRsCommandTrait;

    /**
     * The name and signature of the console command
     * @var string
     */
    protected $signature = 'aamroni:permission-install';

    /**
     * The console command description
     * @var string
     */
    protected $description = 'Generate the OpenSSL RSA256 encryption keys';

    /**
     * Execute the console command
     * @return void
     */
    public function handle(): void
    {
        $this->checkIsDirectoryExistOrNot();
        $this->createPublicAndPrivateFile();
        $this->openSSLEncryptionShellExec();
        $this->info(string: 'OpenSSL RSA256 encryption generated successfully.');
    }
}
