<?php

namespace RSPR\LaravelStarter;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as SP;
use RSPR\LaravelStarter\Facades\L0g;
use RSPR\LaravelStarter\Helpers\BladeDirectiveHelper;
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
    }

    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('L0g', L0g::class);
    }
}
