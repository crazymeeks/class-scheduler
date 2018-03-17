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

        //Config::set('database.default', 'sqlite_testing');
        
        $app['config']->set('database.default', 'sqlite_testing');
        Artisan::call('migrate:refresh');
        Artisan::call('migrate');
        Artisan::call("db:seed", ['--database' => 'sqlite_testing']);
        
        // Real test DB
        /*$app['config']->set('database.default', 'testing_db_class_scheduler');
        Artisan::call('migrate:refresh');
        Artisan::call('migrate');
        Artisan::call("db:seed", ['--database' => 'testing_db_class_scheduler']);*/
        
        Hash::setRounds(4);

        return $app;
    }
}
