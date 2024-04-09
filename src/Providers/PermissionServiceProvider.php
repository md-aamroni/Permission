<?php

namespace Aamroni\Permission\Providers;

use Aamroni\Permission\Console\AlgoRSCommand;
use Aamroni\Permission\Console\SecretCommand;
use Aamroni\Permission\Facades\Permission;
use Aamroni\Permission\PermissionManager;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register all the signature services
     */
    public function register(): void
    {
        // @todo: bind the facade with concrete class
        $this->app->bind(abstract: Permission::class, concrete: PermissionManager::class);
    }

    /**
     * Bootstrap all the signature services
     */
    public function boot(): void
    {
        // @todo: publish the signature config file
        $this->publishes(paths: [
            __DIR__.'/../../config/permission.php' => config_path(path: 'permission.php'),
        ], groups: 'aamroni-permission');

        // @todo: check if a Laravel request is from the CLI
        if ($this->app->runningInConsole()) {
            $this->commands(commands: [SecretCommand::class, AlgoRSCommand::class]);
        }
    }
}
