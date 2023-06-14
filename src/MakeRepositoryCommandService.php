<?php

namespace Sagni\Repository;

use Illuminate\Support\ServiceProvider;
use Sagni\Repository\MakeRepositoryCommand;

class MakeRepositoryCommandService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }
    

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
    protected function registerCommands(): void
    {
        $this->commands([
            MakeRepositoryCommand::class,
        ]);
    }
}
