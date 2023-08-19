<?php

namespace RSPR\LaravelStarter;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider as SP;
use RSPR\LaravelStarter\Facades\L0g;
use RSPR\LaravelStarter\Helpers\BladeDirectiveHelper;

class ServiceProvider extends SP
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        BladeDirectiveHelper::register();
    }

    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('L0g', L0g::class);
    }
}
