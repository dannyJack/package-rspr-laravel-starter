<?php

namespace RSPR\LaravelStarter\Helpers;

class LogHelper
{
    /*======================================================================
    .* CONSTANTS
    .*======================================================================*/

    const DEBUGTRACE_CNT = 4;
    const TYPE_EMERGENCY = 'emergency';
    const TYPE_ALERT = 'alert';
    const TYPE_CRITICAL = 'critical';
    const TYPE_ERROR = 'error';
    const TYPE_WARNING = 'warning';
    const TYPE_NOTICE = 'notice';
    const TYPE_INFO = 'info';
    const TYPE_DEBUG = 'debug';

    /*======================================================================
    .* PROPERTIES
    .*======================================================================*/

    private $channel = null;

    /*======================================================================
    .* CONSTRUCTOR
    .*======================================================================*/

    /**
     * @param string $channel - Log channel to be used
     */
    public function __construct($channel)
    {
        $this->channel = $channel;
    }

    /*======================================================================
    .* STATIC METHODS
    .*======================================================================*/

    /**
     * LogHelper::constructMessage($type, $message)
     * construct message for information/error log
     *
     * @param LogHelper::TYPE_ (String) $type
     * @param string $message
     * @param array $params [title][code][user][otherDetails][traceCount][...]
     * @return string $logMessage;
     */
    public static function constructMessage($type, $message, object|array|string|int $params = [], int $debugTraceStartIndex = 1, null|int $debugTraceCount = null, null|int $debugTraceFilePathCharacterLimit = null, null|int $endLineUnderscoreCount = null)
    {
        $logMessage = "";
        $debug_trace = debug_backtrace();

        // $params checking
        if (empty($params)) {
            $params = [];
        } else {
            if (is_object($params)) {
                $params = json_decode(json_encode($params), true);
            }

            if (!is_array($params)) {
                $params = [$params];
            }
        }

        foreach ($params as $key => $value) {
            if (is_object($value)) {
                $params[$key] = json_decode(json_encode($value), true);
            }
        }

        // Backtrace Title
        if (!empty($debug_trace[$debugTraceStartIndex + 1])) {
            if (isset($debug_trace[$debugTraceStartIndex + 1]['file'])) {
                if (!empty($debug_trace[$debugTraceStartIndex + 1]['file']) && !empty($debug_trace[$debugTraceStartIndex + 1]['line'])) {
                    $_file = explode('/', $debug_trace[$debugTraceStartIndex + 1]['file']);
                    $_file = end($_file);
                    $logMessage .= "***" . $_file;

                    if (!empty($debug_trace[2]['function'])) {
                        $logMessage .= "@" . $debug_trace[2]['function'];
                    }

                    $logMessage .= ':' . $debug_trace[$debugTraceStartIndex + 1]['line'] . '***';
                }
            }
        }

        // Message
        if (!empty($message)) {
            $logMessage .= "\nMessage: \"" . $message . '"';
        }

        // Other details
        $ctr = 0;
        $otherDetailsStr = "\n";

        foreach ($params as $id => $value) {
            if ($ctr != 0) {
                $otherDetailsStr .= "\n";
            }

            if (is_array($value)) {
                $str = '';

                foreach ($value as $id2 => $p2) {
                    $str .= "✦";
                    $str .= $id2 . ": ";
                    if (is_array($p2)) {
                        $str .= json_encode($p2);
                    } elseif (is_bool($p2)) {
                        $str .= (int)$p2;
                    } else {
                        $str .= $p2;
                    }
                }
            } elseif (is_object($value)) {
                $value = json_decode(json_encode($value), true);
            } elseif (is_bool($value)) {
                $str = (int)$value;
            } else {
                $str = $value;
            }

            $otherDetailsStr .= '| ' . $id . ': ' . $str;
            $ctr++;
        }

        if (!empty($otherDetailsStr)) {
            $logMessage .= "\n" . $otherDetailsStr;
        }

        // Backtrace count
        if (!is_null(config('rsprLog.forceAllTraceCount'))) {
            $debugTraceCount = config('rsprLog.forceAllTraceCount', 3);
        } else {
            if (is_null($debugTraceCount)) {
                $debugTraceCount = config('rsprLog.traceCount', 3);
            }
        }

        if (is_null($debugTraceFilePathCharacterLimit)) {
            $debugTraceFilePathCharacterLimit = config('rsprLog.traceFilePathCharacterLimit');
        }

        if (!is_null($debugTraceFilePathCharacterLimit)) {
            if (is_numeric($debugTraceFilePathCharacterLimit)) {
                $debugTraceFilePathCharacterLimit = abs((int)$debugTraceFilePathCharacterLimit);
                $debugTraceFilePathCharacterLimit = $debugTraceFilePathCharacterLimit - ($debugTraceFilePathCharacterLimit * 2);
            } else {
                $debugTraceFilePathCharacterLimit = null;
            }
        }

        // Function back trace
        if (!empty($debug_trace)) {
            if (!empty($debug_trace[$debugTraceStartIndex])) {
                if (!empty($debug_trace[$debugTraceStartIndex]['file'])) {
                    $logMessage .= "\n\nFile trace:";
                    $logMessage .= "\n\tfile:";

                    foreach ($debug_trace as $ind => $trace) {
                        if ($ind >= $debugTraceStartIndex) {
                            if ($ind - $debugTraceStartIndex > ($debugTraceCount - 1)) {
                                break;
                            }

                            $logMessage .= "\n\t\t";
                            $fileTraceFullPath = isset($trace['file']) ? $trace['file'] : '';

                            if (!empty($trace['line'])) {
                                $fileTraceFullPath .= '@' . $trace['line'];
                            }

                            if (!empty($debug_trace[$ind + 1])) {
                                if (!empty($debug_trace[$ind + 1]['function'])) {
                                    $fileTraceFullPath .= ' Function: ' . $debug_trace[$ind + 1]['function'] . '()';
                                }
                            }

                            if (is_null($debugTraceFilePathCharacterLimit)) {
                                $logMessage .= $fileTraceFullPath;
                            } else {
                                if (strlen($fileTraceFullPath) > abs($debugTraceFilePathCharacterLimit)) {
                                    $logMessage .= '...' . substr($fileTraceFullPath, $debugTraceFilePathCharacterLimit);
                                } else {
                                    $logMessage .= $fileTraceFullPath;
                                }
                            }
                        }
                    }
                }
            }
        }

        if (is_null($endLineUnderscoreCount)) {
            $endLineUnderscoreCount = config('rsprLog.endLineUnderscoreCount', 173);
        }

        $logMessage .= "\n" . str_pad('', $endLineUnderscoreCount, '_', STR_PAD_RIGHT);
        return $logMessage;
    }
}
