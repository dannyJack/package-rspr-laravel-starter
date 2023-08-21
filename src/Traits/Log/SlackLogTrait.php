<?php

namespace RSPR\LaravelStarter\Traits\Log;

use RSPR\LaravelStarter\Facades\L0g;
use RSPR\LaravelStarter\Foundation\Log\LogHelper;

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
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function emergency(string $message, ...$params)
    {
        self::log($message, [], LogHelper::TYPE_EMERGENCY);
    }

    /**
     * SlackLogTrait::alert($message)
     * send slack log message
     * Action must be taken immediately.
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function alert(string $message, ...$params)
    {
        self::log($message, [], LogHelper::TYPE_ALERT);
    }

    /**
     * SlackLogTrait::critical($message)
     * send slack log message
     * Critical conditions.
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function critical(string $message, ...$params)
    {
        self::log($message, [], LogHelper::TYPE_CRITICAL);
    }

    /**
     * SlackLogTrait::error($message)
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
        self::log($message, [], LogHelper::TYPE_ERROR);
    }

    /**
     * SlackLogTrait::warning($message)
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
        self::log($message, [], LogHelper::TYPE_WARNING);
    }

    /**
     * SlackLogTrait::notice($message)
     * send slack log message
     * Normal but significant events.
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function notice(string $message, ...$params)
    {
        self::log($message, [], LogHelper::TYPE_NOTICE);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * SlackLogTrait::info($message)
     * send slack log message
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function info(string $message, ...$params)
    {
        self::log($message, [], LogHelper::TYPE_INFO);
    }

    /**
     * SlackLogTrait::debug($message)
     * send slack log message
     * Detailed debug information.
     *
     * @param string $message
     * @param object|array|string|int ...$params
     * @return void
     */
    public static function debug(string $message, ...$params)
    {
        self::log($message, [], LogHelper::TYPE_DEBUG);
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
    private static function preProcessMessage($message)
    {
        $rtn = $message;

        if (!empty(config('slackLog.projectName', ''))) {
            $str = 'Project Name: ' . config('slackLog.projectName', '') . "\n";
            $rtn = $str . $message;
        }

        return $rtn;
    }

    /**
     * @param string $message
     * @param array $params
     * @param int $logType
     * @return void
     */
    private static function log(string $message, $params, int $logType)
    {
        $allowLog = false;
        $channel = config('slackLog.channel', null);

        if (config('slackLog.enable', false)) {
            if (!empty(config('slackLog.webhookUrl', ''))) {
                $message = self::preProcessMessage($message);
                $allowLog = true;
            } else {
                L0g::error('Slack Log is not working properly.', [
                    'slackLog.channel' => $channel,
                    'slackLog.enable' => config('slackLog.enable', false),
                    'slackLog.webhookUrl' => config('slackLog.webhookUrl', ''),
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
