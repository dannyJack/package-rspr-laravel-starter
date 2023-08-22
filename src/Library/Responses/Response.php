<?php

namespace RSPR\LaravelStarter\Library\Responses;

class Response
{
    const RESPONSE_IS_ITEM = false;
    const RESPONSE_IS_LIST = false;

    public array $responseCheckList = [
        'data',
        'hasData',
        'success'
    ];

    public function getData()
    {
        return $this->data;
    }
}
