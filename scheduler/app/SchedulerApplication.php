<?php

namespace Scheduler\App;

use Illuminate\Foundation\Application;

class SchedulerApplication extends Application
{
    /**
     * The application namespace.
     *
     * @var string
     */
    protected $namespace = 'Scheduler\App';


    /**
     * Get the path to the application "app" directory.
     *
     * @param  string  $path Optionally, a path to append to the app path
     * @return string
     */
    public function path($path = '')
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'scheduler' . DIRECTORY_SEPARATOR . 'app' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

}