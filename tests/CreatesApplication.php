<?php

namespace Tests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Console\Kernel;
use Artisan;
trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $app['config']->set('database.default', 'sqlite_testing');
        //Config::set('database.default', 'sqlite_testing');
        Artisan::call('migrate:refresh');
        Artisan::call('migrate');
        Artisan::call("db:seed", ['--database' => 'sqlite_testing']);
        
        Hash::setRounds(4);

        return $app;
    }
}
