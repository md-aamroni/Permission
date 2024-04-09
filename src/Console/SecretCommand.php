<?php

namespace Aamroni\Permission\Console;

use Aamroni\Permission\Traits\SecretCommandTrait;
use Illuminate\Console\Command;

class SecretCommand extends Command
{
    use SecretCommandTrait;

    /**
     * The name and signature of the console command
     * @var string
     */
    protected $signature = 'aamroni:permission-secret
        {--s|show : Display the key instead of modifying files.}
        {--always-no : Skip generating key if it already exists.}
        {--f|force : Skip confirmation when overwriting an existing key.}';

    /**
     * The console command description
     * @var string
     */
    protected $description = 'Generate the JWT auth signing token';

    /**
     * Execute the console command
     * @return void
     */
    public function handle(): void
    {
        $this->displayTheCurrentGeneratedSecret();
        $this->checkWhetherSecretIsExistedOrNot();
        $this->createOrUpdateJsonWebTokenSecret();
        $this->shouldDisplayTheStoredAuthSecret();
    }
}
