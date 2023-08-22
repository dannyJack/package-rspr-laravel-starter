<?php
use RSPR\LaravelStarter\Facades\L0g;
use RSPR\LaravelStarter\Facades\SlackLog;
use RSPR\LaravelStarter\Helpers\LogHelper;

class RSPRLog
{
    /*======================================================================
    .* STATIC METHODS
    .*======================================================================*/

    /**
     * L0gTrait::emergency($message)
     *
     * System is unusable.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function emergency(string $message, object|array|string|int $params = [], null|int $debugTraceCount = null)
    {
        self::log(LogHelper::TYPE_EMERGENCY, $message, $params, $debugTraceCount);
    }

    /**
     * L0gTrait::alert($message)
     *
     * Action must be taken immediately.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function alert(string $message, object|array|string|int $params = [], null|int $debugTraceCount = null)
    {
        self::log(LogHelper::TYPE_ALERT, $message, $params, $debugTraceCount);
    }

    /**
     * L0gTrait::critical($message)
     *
     * Critical conditions.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function critical(string $message, object|array|string|int $params = [], null|int $debugTraceCount = null)
    {
        self::log(LogHelper::TYPE_CRITICAL, $message, $params, $debugTraceCount);
    }

    /**
     * L0gTrait::error($message)
     *
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function error($message, object|array|string|int $params = [], null|int $debugTraceCount = null)
    {
        self::log(LogHelper::TYPE_ERROR, $message, $params, $debugTraceCount);
    }

    /**
     * L0gTrait::warning($message)
     *
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function warning($message, object|array|string|int $params = [], null|int $debugTraceCount = null)
    {
        self::log(LogHelper::TYPE_WARNING, $message, $params, $debugTraceCount);
    }

    /**
     * L0gTrait::notice($message)
     *
     * Normal but significant events.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function notice(string $message, object|array|string|int $params = [], null|int $debugTraceCount = null)
    {
        self::log(LogHelper::TYPE_NOTICE, $message, $params, $debugTraceCount);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * L0gTrait::info($message)
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function info(string $message, object|array|string|int $params = [], null|int $debugTraceCount = null)
    {
        self::log(LogHelper::TYPE_INFO, $message, $params, $debugTraceCount);
    }

    /**
     * L0gTrait::debug($message)
     *
     * Detailed debug information.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function debug(string $message, object|array|string|int $params = [], null|int $debugTraceCount = null)
    {
        self::log(LogHelper::TYPE_DEBUG, $message, $params, $debugTraceCount);
    }

    /*======================================================================
    .* PRIVATE STATIC METHODS
    .*======================================================================*/

    /**
     * @param string $logType
     * @param string $message
     * @param object|array|string|int $params
     * @param null|int $debugTraceCount
     * @return void
     */
    private static function log(string $logType, string $message, object|array|string|int $params = [], null|int $debugTraceCount = null)
    {
        switch ($logType) {
            case LogHelper::TYPE_EMERGENCY:
                L0g::emergency($message, $params, $debugTraceCount);
                SlackLog::emergency($message, $params, $debugTraceCount);
                break;
            case LogHelper::TYPE_ALERT:
                L0g::alert($message, $params, $debugTraceCount);
                SlackLog::alert($message, $params, $debugTraceCount);
                break;
            case LogHelper::TYPE_CRITICAL:
                L0g::critical($message, $params, $debugTraceCount);
                SlackLog::critical($message, $params, $debugTraceCount);
                break;
            case LogHelper::TYPE_ERROR:
                L0g::error($message, $params, $debugTraceCount);
                SlackLog::error($message, $params, $debugTraceCount);
                break;
            case LogHelper::TYPE_WARNING:
                L0g::warning($message, $params, $debugTraceCount);
                SlackLog::warning($message, $params, $debugTraceCount);
                break;
            case LogHelper::TYPE_NOTICE:
                L0g::notice($message, $params, $debugTraceCount);
                SlackLog::notice($message, $params, $debugTraceCount);
                break;
            case LogHelper::TYPE_INFO:
                L0g::info($message, $params, $debugTraceCount);
                SlackLog::info($message, $params, $debugTraceCount);
                break;
            case LogHelper::TYPE_DEBUG:
                L0g::debug($message, $params, $debugTraceCount);
                SlackLog::debug($message, $params, $debugTraceCount);
                break;
            default:
                break;
        }
    }
}
