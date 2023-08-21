<?php

namespace RSPR\LaravelStarter\Traits\Log;

use RSPR\LaravelStarter\Facades\L0g;
use RSPR\LaravelStarter\Helpers\LogHelper;

trait SlackLogTrait
{
    /*======================================================================
     * STATIC METHODS
     *======================================================================*/

    /**
     * SlackLogTrait::emergency($message)
     * send slack log message
     * System is unusable.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function emergency(string $message, ...$params)
    {
        self::log(LogHelper::TYPE_EMERGENCY, $message, []);
    }

    /**
     * SlackLogTrait::alert($message)
     * send slack log message
     * Action must be taken immediately.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function alert(string $message, ...$params)
    {
        self::log(LogHelper::TYPE_ALERT, $message, []);
    }

    /**
     * SlackLogTrait::critical($message)
     * send slack log message
     * Critical conditions.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function critical(string $message, ...$params)
    {
        self::log(LogHelper::TYPE_CRITICAL, $message, []);
    }

    /**
     * SlackLogTrait::error($message)
     *
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function error($message, ...$params)
    {
        self::log(LogHelper::TYPE_ERROR, $message, []);
    }

    /**
     * SlackLogTrait::warning($message)
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
    public static function warning($message, ...$params)
    {
        self::log(LogHelper::TYPE_WARNING, $message, []);
    }

    /**
     * SlackLogTrait::notice($message)
     * send slack log message
     * Normal but significant events.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function notice(string $message, ...$params)
    {
        self::log(LogHelper::TYPE_NOTICE, $message, []);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * SlackLogTrait::info($message)
     * send slack log message
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function info(string $message, ...$params)
    {
        self::log(LogHelper::TYPE_INFO, $message, []);
    }

    /**
     * SlackLogTrait::debug($message)
     * send slack log message
     * Detailed debug information.
     *
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    public static function debug(string $message, ...$params)
    {
        self::log(LogHelper::TYPE_DEBUG, $message, []);
    }

    /*======================================================================
     * PRIVATE STATIC METHODS
     *======================================================================*/

    /**
     * SlackLogTrait::message($message)
     * pre-processing message
     *
     * @param string $message
     * @return string $rtn
     */
    private static function preProcessMessage(string $message)
    {
        $rtn = $message;

        if (!empty(config('rsprLog.projectName', ''))) {
            $str = 'Project Name: ' . config('rsprLog.projectName', '') . "\n";
            $rtn = $str . $message;
        }

        return $rtn;
    }

    /**
     * @param string $logType
     * @param string $message
     * @param object|array|string|int $params
     * @return void
     */
    private static function log(string $logType, string $message, object|array|string|int $params = [])
    {
        $allowLog = false;
        $channel = config('rsprLog.slack.channel', null);

        if (config('rsprLog.slack.enable', false)) {
            if (!empty(config('rsprLog.slack.webhookUrl', ''))) {
                $message = self::preProcessMessage($message);
                $endLineUnderscoreCount = config('rsprLog.slack.endLineUnderscoreCount', config('rsprLog.endLineUnderscoreCount', 173));
                $traceFilePathCharacterLimit = config('rsprLog.slack.traceFilePathCharacterLimit', config('rsprLog.traceFilePathCharacterLimit'));
                $message = LogHelper::constructMessage($logType, $message, $params, 1, null, $traceFilePathCharacterLimit, $endLineUnderscoreCount);
                $allowLog = true;
            } else {
                L0g::error('Slack Log is not working properly.', [
                    'rsprLog.slack.channel' => $channel,
                    'rsprLog.slack.enable' => config('rsprLog.slack.enable', false),
                    'rsprLog.slack.webhookUrl' => config('rsprLog.slack.webhookUrl', ''),
                    'log type' => $logType
                ]);
            }
        }

        if ($allowLog) {
            switch ($logType) {
                case LogHelper::TYPE_EMERGENCY:
                    \Log::channel($channel)->emergency($message);
                    break;
                case LogHelper::TYPE_ALERT:
                    \Log::channel($channel)->alert($message);
                    break;
                case LogHelper::TYPE_CRITICAL:
                    \Log::channel($channel)->critical($message);
                    break;
                case LogHelper::TYPE_ERROR:
                    \Log::channel($channel)->error($message);
                    break;
                case LogHelper::TYPE_WARNING:
                    \Log::channel($channel)->warning($message);
                    break;
                case LogHelper::TYPE_NOTICE:
                    \Log::channel($channel)->notice($message);
                    break;
                case LogHelper::TYPE_INFO:
                    \Log::channel($channel)->info($message);
                    break;
                case LogHelper::TYPE_DEBUG:
                    \Log::channel($channel)->debug($message);
                    break;
                default:
                    break;
            }
        }
    }
}
