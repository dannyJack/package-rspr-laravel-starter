<?php

namespace RSPR\LaravelStarter\Services;

class FileMaker
{
    public static function specifyDataPathAndName($path)
    {
        $rtn = [
            'name' => '',
            'pathArray' => []
        ];

        $pathList1st = explode('/', $path);
        $pathList2nd = [];

        foreach ($pathList1st as $ind => $path) {
            $path = explode('\\', $path);
            $pathList2nd = array_merge($pathList2nd, $path);
        }

        $path = implode('/', $pathList2nd);

        if ($path[0] === '/' || $path[0] === '\\') {
            $path = substr($path, 1);
        }

        if ($path[strlen($path) - 1] === '/' || $path[strlen($path) - 1] === '\\') {
            $path = substr($path, 0, strlen($path) - 1);
        }

        $pathList1st = explode('/', $path);
        $rtn['name'] = array_pop($pathList1st);
        $rtn['pathArray'] = $pathList1st;

        return $rtn;
    }
}
