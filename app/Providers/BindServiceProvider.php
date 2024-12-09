<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    /**
     * The model observers.
     *
     * @var array
     */
    protected array $modelObservers = [];

    /**
     * Register services.
     */
    public function register(): void
    {
        $interfaces = glob(app_path('Contracts/Models/*.php'));

        foreach ($interfaces as $interface) {
            $interface = str_replace('Interface', '', basename($interface, '.php'));

            $interfaceName = 'App\Contracts\Models\\'.$interface.'Interface';
            $repositoryName = 'App\Repositories\Models\\'.$interface.'Repository';

            if (!class_exists($repositoryName)) continue;

            $this->app->bind($interfaceName, $repositoryName);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (app()->runningInConsole()) return;
        if (!empty($this->modelObservers)) return;

        $modelsPath = app_path('Models');
        $observersPath = app_path('Observers');

        $modelFiles = glob($modelsPath.'/*.php');

        foreach ($modelFiles as $modelFile) {
            $modelName = basename($modelFile, '.php');
            $observerName = $modelName.'Observer';

            if (!file_exists($observersPath.'/'.$observerName.'.php')) continue;

            $modelClass = 'App\Models\\'.$modelName;
            $observerClass = 'App\Observers\\'.$observerName;

            $this->modelObservers[$modelClass] = $observerClass;
        }

        foreach ($this->modelObservers as $model => $observer) {
            $model::observe($observer);
        }
    }
}
