<?php

namespace RSPR\LaravelStarter\Facades;

use RSPR\LaravelStarter\Helpers\LogHelper;
use RSPR\LaravelStarter\Interfaces\LogInterface;

class L0g implements LogInterface
{
    /*======================================================================
    .* STATIC METHODS
    .*======================================================================*/

    /**
     * L0g::info($message)
     * call the LogHelper::constructMessage() method
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function info(string $message, ...$params)
    {
        $message = LogHelper::constructMessage(LogHelper::TYPE_INFO, $message, $params);
        \Log::info($message);
    }

    /**
     * L0g::error($message)
     * call the self::constructMessage() method
     *
     * @param string $message
     * @param object|array|string|int ...$params
     */
    public static function error($message, ...$params)
    {
        $message = LogHelper::constructMessage(LogHelper::TYPE_ERROR, $message, $params);
        \Log::error($message);
    }

    /**
     * L0g::warning($message)
     * call the self::constructMessage() method
     *
     * @param string $message
     * @param object|array|string|int ...$params
     */
    public static function warning($message, ...$params)
    {
        $message = LogHelper::constructMessage(LogHelper::TYPE_ERROR, $message, $params);
        \Log::error($message);
    }

    /**
     * L0g::channel($channel)
     * new instantiation of class LogHelper
     *
     * @param string $channel
     */
    public static function channel($channel)
    {
        $rtn = new LogHelper($channel);

        return $rtn;
    }
}
