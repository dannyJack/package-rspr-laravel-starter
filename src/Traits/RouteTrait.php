<?php

namespace RSPR\LaravelStarter\Traits;

trait RouteTrait
{
    /**
     * Check current route name
     *
     * @param string $routeName - the route name to be check
     * @param string $returnStringIfTrue - the return string if true
     * @return string [$name, 'active', '']
     */
    public static function isRoute(null|string $routeName = null, string $returnStringIfTrue = 'active'): bool
    {
        $rtn = '';
        $name = \Request::route()->action['as'];

        if (is_null($routeName)) {
            $rtn = $name;
        } else {
            if (!empty($name)) {
                if (is_array($routeName)) {
                    if (in_array($name, $routeName)) {
                        $rtn = $returnStringIfTrue;
                    }
                } elseif ($name == $routeName) {
                    $rtn = $returnStringIfTrue;
                }
            }
        }

        return $rtn;
    }
}
