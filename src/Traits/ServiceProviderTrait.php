<?php

namespace RSPR\LaravelStarter\Traits;

trait ServiceProviderTrait
{
    private static $dirPathRoot = __DIR__ . '/../../';
    private $pubConfig = [];
    private $pubEnvTemp = [];
    private $pubImagesCommon = [];
    private $pubLangEn = [];
    private $pubLangJa = [];
    private $pubModels = [];
    private $pubPhpcs = [];
    private $pubPublicCss = [];
    private $pubPublicJs = [];
    private $pubResourcesCss = [];
    private $pubResourcesJs = [];
    private $pubResourcesViews = [];
    private $pubViteConfig = [];

    protected function registerPublishers()
    {
        $this->setData();
        $this->publishes($this->pubConfig, 'rspr-config');
        $this->publishes($this->pubEnvTemp, 'rspr-env-temp');
        $this->publishes($this->pubImagesCommon, 'rspr-images-common');
        $this->publishes($this->pubLangEn + $this->pubLangJa, 'rspr-lang');
        $this->publishes($this->pubLangEn, 'rspr-lang-en');
        $this->publishes($this->pubLangJa, 'rspr-lang-ja');
        $this->publishes($this->pubModels, 'rspr-model');
        $this->publishes($this->pubPhpcs, 'rspr-phpcs');
        $this->publishes($this->pubPublicCss, 'rspr-public-css');
        $this->publishes($this->pubPublicJs, 'rspr-public-js');
        $this->publishes($this->pubResourcesCss, 'rspr-resources-css');
        $this->publishes($this->pubResourcesJs, 'rspr-resources-js');
        $this->publishes($this->pubResourcesViews, 'rspr-resources-views');
        $this->publishes($this->pubViteConfig, 'rspr-vite-config');
        $this->publishes(
            $this->pubConfig
            + $this->pubEnvTemp
            + $this->pubImagesCommon
            + $this->pubLangEn
            + $this->pubLangJa
            + $this->pubModels
            + $this->pubPhpcs
            + $this->pubPublicCss
            + $this->pubPublicJs
            + $this->pubResourcesCss
            + $this->pubResourcesJs
            + $this->pubResourcesViews
            + $this->pubViteConfig,
            'rspr-starter'
        );
    }

    private function setData()
    {
        $this->pubConfig = [
            $this->customCurrentPath('config/rsprLog.php') => $this->customProjectPath('config/rsprLog.php')
        ];
        $this->pubEnvTemp = [
            $this->customCurrentPath('root-files/.env.tmp') => $this->customProjectPath('.env.tmp')
        ];
        $this->pubImagesCommon = [
            $this->customCurrentPath('public/images/common/logo.svg') => $this->customProjectPath('public/images/common/logo.svg')
        ];
        $this->pubLangEn = [
            $this->customCurrentPath('lang/en/messages.php') => $this->customProjectPath('lang/en/messages.php'),
            $this->customCurrentPath('lang/en/validation.php') => $this->customProjectPath('lang/en/validation.php'),
            $this->customCurrentPath('lang/en/words.php') => $this->customProjectPath('lang/en/words.php')
        ];
        $this->pubLangJa = [
            $this->customCurrentPath('lang/ja/messages.php') => $this->customProjectPath('lang/ja/messages.php'),
            $this->customCurrentPath('lang/ja/validation.php') => $this->customProjectPath('lang/ja/validation.php'),
            $this->customCurrentPath('lang/ja/words.php') => $this->customProjectPath('lang/ja/words.php')
        ];
        $this->pubModels = [
            $this->customCurrentPath('app/Traits/Model/ModelTrait.php') => $this->customProjectPath('app/Traits/Model/ModelTrait.php'),
            $this->customCurrentPath('app/Models/Model.php') => $this->customProjectPath('app/Models/Model.php'),
            $this->customCurrentPath('app/Models/ModelAuthenticatable.php') => $this->customProjectPath('app/Models/ModelAuthenticatable.php'),
            // $this->customCurrentPath('app/Models/ModelCompoships.php') => $this->customProjectPath('app/Models/ModelCompoships.php')
        ];
        $this->pubPhpcs = [
            $this->customCurrentPath('root-files/phpcs.xml') => $this->customProjectPath('phpcs.xml')
        ];
        $this->pubPublicCss = [
            $this->customCurrentPath('public/css/app.css') => $this->customProjectPath('public/css/app.css')
        ];
        $this->pubPublicJs = [
            $this->customCurrentPath('public/js/app.js') => $this->customProjectPath('public/js/app.js'),
            $this->customCurrentPath('public/js/toastr-message.js') => $this->customProjectPath('public/js/toastr-message.js')
        ];
        $this->pubResourcesCss = [
            $this->customCurrentPath('resources/css/compile.css') => $this->customProjectPath('resources/css/compile.css')
        ];
        $this->pubResourcesJs = [
            $this->customCurrentPath('resources/js/compile.js') => $this->customProjectPath('resources/js/compile.js')
        ];
        $this->pubResourcesViews = [
            $this->customCurrentPath('resources/views/layouts/auth/app.blade.php') => $this->customProjectPath('resources/views/layouts/auth/app.blade.php'),
            $this->customCurrentPath('resources/views/layouts/auth/aside.blade.php') => $this->customProjectPath('resources/views/layouts/auth/aside.blade.php'),
            $this->customCurrentPath('resources/views/layouts/auth/content-header.blade.php') => $this->customProjectPath('resources/views/layouts/auth/content-header.blade.php'),
            $this->customCurrentPath('resources/views/layouts/auth/header.blade.php') => $this->customProjectPath('resources/views/layouts/auth/header.blade.php')
        ];
        $this->pubViteConfig = [
            $this->customCurrentPath('root-files/vite.config.js') => $this->customProjectPath('vite.config.js')
        ];
    }

    private function customCurrentPath(string $extendedPath)
    {
        return self::$dirPathRoot . $extendedPath;
    }

    private function customProjectPath(string $extendedPath)
    {
        return config_path('../' . $extendedPath);
    }
}
