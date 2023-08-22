<?php

namespace RSPR\LaravelStarter\Library\Responses;

class ResponseCheck
{
    public function warning(Response $response, $message = null)
    {
        $toBeCheckValues = $response->responseCheckList;
        $isWarning = false;
        $generalMessage = 'Response warning';
        $returnResponseArray = [];

        if (empty($message)) {
            $message = $generalMessage;
        } else {
            $message = $generalMessage + ': ' + $message;
        }

        $reflectionClass = new \ReflectionClass($response);

        foreach ($toBeCheckValues as $value) {
            if ($reflectionClass->hasProperty($value)) {
                $returnResponseArray[$value] = $response->{$value};

                if ($value === 'data') {
                    if ($response::RESPONSE_IS_ITEM) {
                        if (empty($response->getData())) {
                            $isWarning = true;
                        } elseif ($response->getData()->isEmpty) {
                            $isWarning = true;
                        }
                    } elseif ($response::RESPONSE_IS_LIST) {
                        if (count($response->getData()) === 0) {
                            $isWarning = true;
                        }
                    }
                } else {
                    if (empty($response->{$value})) {
                        $isWarning = true;
                    }
                }
            }
        }

        if ($isWarning) {
            \RSPRLog::warning($message, $returnResponseArray);
        }
    }
}
