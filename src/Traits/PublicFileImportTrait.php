<?php

namespace RSPR\LaravelStarter\Traits;

trait PublicFileImportTrait
{
    /**
     * File versioning e.g css and js files (version is generated by date last modified)
     *
     * @param string $urlFile = URL file path
     * @param bool $onlyVersion = return only the file version
     * @return string $url = Full URL file path
     */
    public static function vers(string $urlFile, bool $onlyVersion = false)
    {
        $url = url($urlFile);
        $version = '';

        $path = public_path($urlFile);
        if (file_exists($path)) {
            $version = filemtime($path);
            $url .= '?v=' . $version;
        }

        if ($onlyVersion) {
            return $version;
        }

        return $url;
    }
}
