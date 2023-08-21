<?php

namespace RSPR\LaravelStarter\Traits\Log;

use RSPR\LaravelStarter\Foundation\Log\LogHelper;

trait L0gTrait
{
    /*======================================================================
    .* METHODS
    .*======================================================================*/

    /**
     * L0gTrait::channel($channel)
     * new instantiation of class LogHelper
     *
     * @param string $channel
     */
    public static function channel($channel)
    {
        $rtn = new LogHelper($channel);

        return $rtn;
    }

    /*======================================================================
    .* STATIC METHODS
    .*======================================================================*/

    /**
     * L0gTrait::emergency($message)
     * call the LogHelper::constructMessage() method
     *
     * System is unusable.
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function emergency(string $message, ...$params)
    {
        self::log($message, $params, LogHelper::TYPE_EMERGENCY);
    }

    /**
     * L0gTrait::alert($message)
     * call the LogHelper::constructMessage() method
     *
     * Action must be taken immediately.
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function alert(string $message, ...$params)
    {
        self::log($message, $params, LogHelper::TYPE_ALERT);
    }

    /**
     * L0gTrait::critical($message)
     * call the LogHelper::constructMessage() method
     *
     * Critical conditions.
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function critical(string $message, ...$params)
    {
        self::log($message, $params, LogHelper::TYPE_CRITICAL);
    }

    /**
     * L0gTrait::error($message)
     * call the self::constructMessage() method
     *
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function error($message, ...$params)
    {
        self::log($message, $params, LogHelper::TYPE_ERROR);
    }

    /**
     * L0gTrait::warning($message)
     * call the self::constructMessage() method
     *
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function warning($message, ...$params)
    {
        self::log($message, $params, LogHelper::TYPE_WARNING);
    }

    /**
     * L0gTrait::notice($message)
     * call the LogHelper::constructMessage() method
     *
     * Normal but significant events.
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function notice(string $message, ...$params)
    {
        self::log($message, $params, LogHelper::TYPE_NOTICE);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * L0gTrait::info($message)
     * call the LogHelper::constructMessage() method
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function info(string $message, ...$params)
    {
        self::log($message, $params, LogHelper::TYPE_INFO);
    }

    /**
     * L0gTrait::debug($message)
     * call the LogHelper::constructMessage() method
     *
     * Detailed debug information.
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function debug(string $message, ...$params)
    {
        self::log($message, $params, LogHelper::TYPE_DEBUG);
    }

    /*======================================================================
    .* PRIVATE STATIC METHODS
    .*======================================================================*/

    /**
     * @param string $message
     * @param array $params
     * @param int $logType
     * @return void
     */
    private static function log(string $message, $params, int $logType)
    {
        $message = LogHelper::constructMessage($logType, $message, $params);

        switch ($logType) {
            case LogHelper::TYPE_EMERGENCY:
                \Log::emergency($message);
                break;
            case LogHelper::TYPE_ALERT:
                \Log::alert($message);
                break;
            case LogHelper::TYPE_CRITICAL:
                \Log::critical($message);
                break;
            case LogHelper::TYPE_ERROR:
                \Log::error($message);
                break;
            case LogHelper::TYPE_WARNING:
                \Log::warning($message);
                break;
            case LogHelper::TYPE_NOTICE:
                \Log::notice($message);
                break;
            case LogHelper::TYPE_INFO:
                \Log::info($message);
                break;
            case LogHelper::TYPE_DEBUG:
                \Log::debug($message);
                break;
            default:
                break;
        }
    }
}
