<?php

namespace RSPR\LaravelStarter\Helpers;

use Illuminate\Support\Facades\Blade;

class BladeDirectiveHelper
{
    public static function register()
    {
        Blade::directive('vers', function (string $urlFile, bool $onlyVersion = false) {
            return PublicFileImportHelper::vers($urlFile, $onlyVersion);
        });
    }
}
