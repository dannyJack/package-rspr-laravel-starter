<?php

namespace RSPR\LaravelStarter\Traits;

trait ServiceProviderTrait
{
    private static $dirPathRoot = __DIR__ . '/../../';
    private $pubAssetElement = [];
    private $pubAssetJsToastr = [];
    private $pubConfig = [];
    private $pubControllerTmp = [];
    private $pubEnvTmp = [];
    private $pubImagesCommon = [];
    private $pubLangEn = [];
    private $pubLangJa = [];
    private $pubManager = [];
    private $pubManagerComplete = [];
    private $pubManagerTmp = [];
    private $pubModel = [];
    private $pubModelTmp = [];
    private $pubPhpcs = [];
    private $pubPublicCss = [];
    private $pubPublicJs = [];
    private $pubPublicJsTmp = [];
    private $pubRepository = [];
    private $pubRepositoryComplete = [];
    private $pubRepositoryTmp = [];
    private $pubResponseOnlyManager = [];
    private $pubResponseOnlyRepository = [];
    private $pubResponseOnlyChild = [];
    private $pubResponseOnlyParent = [];
    private $pubResponse = [];
    private $pubResponseCode = [];
    private $pubResponseCodeTmp = [];
    private $pubResourcesCss = [];
    private $pubResourcesJs = [];
    private $pubResourcesViews = [];
    private $pubResourcesViewsTmp = [];
    private $pubService = [];
    private $pubViteConfig = [];
    private $pubVue = [];
    private $pubVueTmp = [];

    protected function registerPublishers()
    {
        $this->setData();
        $this->publishes($this->pubAssetElement, 'rspr-asset-element');
        $this->publishes($this->pubAssetJsToastr, 'rspr-asset-js-toastr');
        $this->publishes($this->pubConfig, 'rspr-config');
        $this->publishes($this->pubControllerTmp, 'rspr-controller');
        $this->publishes($this->pubEnvTmp, 'rspr-env-temp');
        $this->publishes($this->pubImagesCommon, 'rspr-images-common');
        $this->publishes($this->pubLangEn + $this->pubLangJa, 'rspr-lang');
        $this->publishes($this->pubLangEn, 'rspr-lang-en');
        $this->publishes($this->pubLangJa, 'rspr-lang-ja');
        $this->publishes($this->pubManager, 'rspr-manager');
        $this->publishes($this->pubManagerComplete, 'rspr-manager-complete');
        $this->publishes($this->pubManagerTmp, 'rspr-manager-tmp');
        $this->publishes($this->pubModel, 'rspr-model');
        $this->publishes($this->pubModelTmp, 'rspr-model-tmp');
        $this->publishes($this->pubPhpcs, 'rspr-phpcs');
        $this->publishes($this->pubPublicCss, 'rspr-public-css');
        $this->publishes($this->pubPublicJs, 'rspr-public-js');
        $this->publishes($this->pubPublicJsTmp, 'rspr-public-js-tmp');
        $this->publishes($this->pubRepository, 'rspr-repository');
        $this->publishes($this->pubRepositoryComplete, 'rspr-repository-complete');
        $this->publishes($this->pubRepositoryTmp, 'rspr-repository-tmp');
        $this->publishes($this->pubResponseOnlyManager, 'rspr-response-manager');
        $this->publishes($this->pubResponseOnlyRepository, 'rspr-response-repository');
        $this->publishes($this->pubResponseOnlyChild, 'rspr-response-child');
        $this->publishes($this->pubResponseOnlyParent, 'rspr-response-parent');
        $this->publishes($this->pubResponse, 'rspr-response');
        $this->publishes($this->pubResponseCode, 'rspr-response-code');
        $this->publishes($this->pubResponseCodeTmp, 'rspr-response-code-tmp');
        $this->publishes($this->pubResourcesCss, 'rspr-resources-css');
        $this->publishes($this->pubResourcesJs, 'rspr-resources-js');
        $this->publishes($this->pubResourcesViews, 'rspr-resources-views');
        $this->publishes($this->pubService, 'rspr-service');
        $this->publishes($this->pubViteConfig, 'rspr-vite-config');
        $this->publishes($this->pubVue, 'rspr-vue');
        $this->publishes($this->pubVueTmp, 'rspr-vue-tmp');
        $this->publishes(
            $this->pubConfig
            + $this->pubControllerTmp
            + $this->pubEnvTmp
            + $this->pubImagesCommon
            + $this->pubLangEn
            + $this->pubLangJa
            + $this->pubManager
            + $this->pubModel
            + $this->pubPhpcs
            + $this->pubPublicCss
            + $this->pubPublicJs
            + $this->pubRepository
            + $this->pubResponse
            + $this->pubResponseCode
            + $this->pubResourcesCss
            + $this->pubResourcesJs
            + $this->pubResourcesViews
            + $this->pubService
            + $this->pubViteConfig,
            'rspr-starter'
        );
        $this->publishes(
            $this->pubControllerTmp
            + $this->pubEnvTmp
            + $this->pubManagerTmp
            + $this->pubModelTmp
            + $this->pubPublicJsTmp
            + $this->pubRepositoryTmp
            + $this->pubResponseCodeTmp
            + $this->pubResourcesViewsTmp
            + $this->pubVueTmp,
            'rspr-tmp'
        );
    }

    private function setData()
    {
        $this->pubAssetElement = [
            $this->customCurrentPath('resources/views/assets/element/common/asset-el-validation-error.blade.php') => $this->customProjectPath('resources/views/assets/element/common/asset-el-validation-error.blade.php')
        ];
        $this->pubAssetJsToastr = [
            $this->customCurrentPath('public/js/toastr-message.js') => $this->customProjectPath('public/js/toastr-message.js'),
            $this->customCurrentPath('resources/views/assets/js/common/asset-js-toastr-message.blade.php.txt') => $this->customProjectPath('resources/views/assets/js/common/asset-js-toastr-message.blade.php')
        ];
        $this->pubConfig = [
            $this->customCurrentPath('config/rsprLog.php.txt') => $this->customProjectPath('config/rsprLog.php')
        ];
        $this->pubControllerTmp = [
            $this->customCurrentPath('app/Http/Controllers/UserController.php.tmp') => $this->customProjectPath('app/Http/Controllers/UserController.php.tmp'),
            $this->customCurrentPath('app/Http/Controllers/UserController2.php.tmp') => $this->customProjectPath('app/Http/Controllers/UserController2.php.tmp')
        ];
        $this->pubEnvTmp = [
            $this->customCurrentPath('root-files/.env.tmp') => $this->customProjectPath('.env.tmp')
        ];
        $this->pubImagesCommon = [
            $this->customCurrentPath('public/images/common/logo.svg') => $this->customProjectPath('public/images/common/logo.svg')
        ];
        $this->pubLangEn = [
            $this->customCurrentPath('lang/en/messages.php.txt') => $this->customProjectPath('lang/en/messages.php'),
            $this->customCurrentPath('lang/en/validation.php.txt') => $this->customProjectPath('lang/en/validation.php'),
            $this->customCurrentPath('lang/en/words.php.txt') => $this->customProjectPath('lang/en/words.php')
        ];
        $this->pubLangJa = [
            $this->customCurrentPath('lang/ja/messages.php.txt') => $this->customProjectPath('lang/ja/messages.php'),
            $this->customCurrentPath('lang/ja/validation.php.txt') => $this->customProjectPath('lang/ja/validation.php'),
            $this->customCurrentPath('lang/ja/words.php.txt') => $this->customProjectPath('lang/ja/words.php')
        ];
        $this->pubManager = [
            $this->customCurrentPath('app/Managers/Manager.php.txt') => $this->customProjectPath('app/Managers/Manager.php'),
            $this->customCurrentPath('app/Managers/UserManager.php.tmp') => $this->customProjectPath('app/Managers/UserManager.php.tmp')
        ];
        $this->pubManagerTmp = [
            $this->customCurrentPath('app/Managers/UserManager.php.tmp') => $this->customProjectPath('app/Managers/UserManager.php.tmp')
        ];
        $this->pubModel = [
            $this->customCurrentPath('app/Models/User.php.tmp') => $this->customProjectPath('app/Models/User.php.tmp'),
            $this->customCurrentPath('app/Traits/Model/ModelTrait.php.txt') => $this->customProjectPath('app/Traits/Model/ModelTrait.php'),
            $this->customCurrentPath('app/Models/Model.php.txt') => $this->customProjectPath('app/Models/Model.php'),
            $this->customCurrentPath('app/Models/ModelAuthenticatable.php.txt') => $this->customProjectPath('app/Models/ModelAuthenticatable.php'),
            // $this->customCurrentPath('app/Models/ModelCompoships.php.txt') => $this->customProjectPath('app/Models/ModelCompoships.php')
        ];
        $this->pubModelTmp = [
            $this->customCurrentPath('app/Models/User.php.tmp') => $this->customProjectPath('app/Models/User.php.tmp')
        ];
        $this->pubPhpcs = [
            $this->customCurrentPath('root-files/phpcs.xml') => $this->customProjectPath('phpcs.xml')
        ];
        $this->pubPublicCss = [
            $this->customCurrentPath('public/css/app.css') => $this->customProjectPath('public/css/app.css')
        ];
        $this->pubPublicJs = [
            $this->customCurrentPath('public/js/app.js') => $this->customProjectPath('public/js/app.js'),
            $this->customCurrentPath('public/js/toastr-message.js') => $this->customProjectPath('public/js/toastr-message.js'),
            $this->customCurrentPath('public/js/page/user.js.tmp') => $this->customProjectPath('public/js/page/user.js.tmp')
        ];
        $this->pubPublicJsTmp = [
            $this->customCurrentPath('public/js/page/user.js.tmp') => $this->customProjectPath('public/js/page/user.js.tmp')
        ];
        $this->pubRepository = [
            $this->customCurrentPath('app/Repositories/Repository.php.txt') => $this->customProjectPath('app/Repositories/Repository.php'),
            $this->customCurrentPath('app/Repositories/UserRepository.php.tmp') => $this->customProjectPath('app/Repositories/UserRepository.php.tmp')
        ];
        $this->pubRepositoryTmp = [
            $this->customCurrentPath('app/Repositories/UserRepository.php.tmp') => $this->customProjectPath('app/Repositories/UserRepository.php.tmp')
        ];
        $this->pubResponseOnlyManager = [
            $this->customCurrentPath('app/Responses/Manager/ManagerResponse.php.txt') => $this->customProjectPath('app/Responses/Manager/ManagerResponse.php')
        ];
        $this->pubResponseOnlyRepository = [
            $this->customCurrentPath('app/Responses/Repository/RepositoryResponseCollection.php.txt') => $this->customProjectPath('app/Responses/Repository/RepositoryResponseCollection.php'),
            $this->customCurrentPath('app/Responses/Repository/RepositoryResponseItem.php.txt') => $this->customProjectPath('app/Responses/Repository/RepositoryResponseItem.php'),
            $this->customCurrentPath('app/Responses/Repository/RepositoryResponsePagination.php.txt') => $this->customProjectPath('app/Responses/Repository/RepositoryResponsePagination.php'),
        ];
        $this->pubResponseOnlyChild = array_merge([
            //
        ], $this->pubResponseOnlyManager, $this->pubResponseOnlyRepository);
        $this->pubResponseOnlyParent = [
            $this->customCurrentPath('app/Responses/ResponseItem.php.txt') => $this->customProjectPath('app/Responses/ResponseItem.php'),
            $this->customCurrentPath('app/Responses/ResponseList.php.txt') => $this->customProjectPath('app/Responses/ResponseList.php'),
        ];
        $this->pubResponse = array_merge([
            //
        ], $this->pubResponseOnlyChild, $this->pubResponseOnlyParent);
        $this->pubResponseCode = [
            $this->customCurrentPath('app/ResponseCodes/ResponseCode.php.txt') => $this->customProjectPath('app/ResponseCodes/ResponseCode.php'),
            $this->customCurrentPath('app/ResponseCodes/Manager/UserResponseCode.php.tmp') => $this->customProjectPath('app/ResponseCodes/Manager/UserResponseCode.php.tmp')
        ];
        $this->pubResponseCodeTmp = [
            $this->customCurrentPath('app/ResponseCodes/Manager/UserResponseCode.php.tmp') => $this->customProjectPath('app/ResponseCodes/Manager/UserResponseCode.php.tmp')
        ];
        $this->pubResourcesCss = [
            $this->customCurrentPath('resources/css/compile.css') => $this->customProjectPath('resources/css/compile.css')
        ];
        $this->pubResourcesJs = [
            $this->customCurrentPath('resources/js/compile.js') => $this->customProjectPath('resources/js/compile.js')
        ];
        $this->pubResourcesViews = array_merge([
            $this->customCurrentPath('resources/views/layouts/auth/app.blade.php.txt') => $this->customProjectPath('resources/views/layouts/auth/app.blade.php'),
            $this->customCurrentPath('resources/views/layouts/auth/aside.blade.php.txt') => $this->customProjectPath('resources/views/layouts/auth/aside.blade.php'),
            $this->customCurrentPath('resources/views/layouts/auth/content-header.blade.php.txt') => $this->customProjectPath('resources/views/layouts/auth/content-header.blade.php'),
            $this->customCurrentPath('resources/views/layouts/auth/header.blade.php.txt') => $this->customProjectPath('resources/views/layouts/auth/header.blade.php'),
            $this->customCurrentPath('resources/views/layouts/common/app.blade.php.txt') => $this->customProjectPath('resources/views/layouts/common/app.blade.php'),
            $this->customCurrentPath('resources/views/assets/js/common/asset-js-toastr-message.blade.php.txt') => $this->customProjectPath('resources/views/assets/js/common/asset-js-toastr-message.blade.php'),
            $this->customCurrentPath('resources/views/pages/auth/dashboard/index.blade.php.txt') => $this->customProjectPath('resources/views/pages/auth/dashboard/index.blade.php'),
            $this->customCurrentPath('resources/views/pages/guest/auth/login.blade.php.txt') => $this->customProjectPath('resources/views/pages/guest/auth/login.blade.php'),
            $this->customCurrentPath('resources/views/layouts/sample.blade.php.tmp') => $this->customProjectPath('resources/views/layouts/sample.blade.php.tmp'),
            $this->customCurrentPath('resources/views/pages/sample.blade.php.tmp') => $this->customProjectPath('resources/views/pages/sample.blade.php.tmp')
        ], $this->pubAssetElement);
        $this->pubResourcesViewsTmp = [
            $this->customCurrentPath('resources/views/layouts/sample.blade.php.tmp') => $this->customProjectPath('resources/views/layouts/sample.blade.php.tmp'),
            $this->customCurrentPath('resources/views/pages/sample.blade.php.tmp') => $this->customProjectPath('resources/views/pages/sample.blade.php.tmp')
        ];
        $this->pubService = [
            $this->customCurrentPath('app/Services/GlobalProjectService.php.txt') => $this->customProjectPath('app/Services/GlobalProjectService.php')
        ];
        $this->pubViteConfig = [
            $this->customCurrentPath('root-files/vite.config.js') => $this->customProjectPath('vite.config.js')
        ];
        $this->pubVue = [
            $this->customCurrentPath('public/js/vue-component.js') => $this->customProjectPath('public/js/vue-component.js'),
            $this->customCurrentPath('resources/js/compile-vue.js') => $this->customProjectPath('resources/js/compile-vue.js'),
            $this->customCurrentPath('resources/js/components/HelloWorld.vue.tmp') => $this->customProjectPath('resources/js/components/HelloWorld.vue.tmp'),
        ];
        $this->pubVueTmp = [
            $this->customCurrentPath('resources/js/components/HelloWorld.vue.tmp') => $this->customProjectPath('resources/js/components/HelloWorld.vue.tmp'),
            $this->customCurrentPath('resources/views/layouts/sample.blade.php.tmp') => $this->customProjectPath('resources/views/layouts/sample.blade.php.tmp'),
            $this->customCurrentPath('resources/views/pages/sample.blade.php.tmp') => $this->customProjectPath('resources/views/pages/sample.blade.php.tmp')
        ];

        // DAN (2023/08/31 08:20) - other publishers

        $this->pubRepositoryComplete = array_merge([
            //
        ], $this->pubRepository, $this->pubResponseOnlyRepository, $this->pubResponseOnlyParent);
        $this->pubManagerComplete = array_merge([
            //
        ], $this->pubManager, $this->pubResponseOnlyManager, $this->pubResponseOnlyParent, $this->pubResponseCode, $this->pubRepository, $this->pubResponseOnlyRepository);
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
