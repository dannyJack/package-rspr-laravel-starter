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

        Blade::directive('vueJson', function ($expression) {
            return "<?php echo '\"' . e(json_encode($expression)) . '\"'; ?>";
        });

        Blade::directive('vueSetup', function () {
            return "<?php if(View::hasSection('has-vue')): ?>
                <script>
                    window.defaultLocale = \"<?= config('app.locale') ?>\";
                    window.fallbackLocale = \"<?= config('app.fallback_locale') ?>\";
                    window.languageResourceVersion = \"<?= rspr::vers('app/public/lang/language-resource.json', true, true) ?>\";
                </script>
                <script src=\"<?= rspr::vers('js/vue-component.js') ?>\" defer></script>
            <?php endif; ?>";
        });
    }
}
