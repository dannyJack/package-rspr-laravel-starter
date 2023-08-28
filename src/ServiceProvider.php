<?php

namespace RSPR\LaravelStarter;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as SP;
use RSPR\LaravelStarter\Commands\MakeManager;
use RSPR\LaravelStarter\Commands\MakeRepository;
use RSPR\LaravelStarter\Commands\MakeResponseCode;
use RSPR\LaravelStarter\Library\L0g;
use RSPR\LaravelStarter\Helpers\BladeDirectiveHelper;
use RSPR\LaravelStarter\Library\SlackLog;
use RSPR\LaravelStarter\Traits\ServiceProviderTrait;

class ServiceProvider extends SP
{
    use ServiceProviderTrait;

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->registerPublishers();
        BladeDirectiveHelper::register();
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeManager::class,
                MakeRepository::class,
                MakeResponseCode::class
            ]);
        }
    }

    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('L0g', L0g::class);
        $loader->alias('SlackLog', SlackLog::class);
    }
}
