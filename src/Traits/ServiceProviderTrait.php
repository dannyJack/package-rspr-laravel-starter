<?php

namespace RSPR\LaravelStarter\Traits;

trait ServiceProviderTrait
{
    private $pubConfig = [];

    protected function registerPublishers()
    {
        $this->setData();
        $this->publishes($this->pubConfig, 'rspr-config');
    }

    private function setData()
    {
        $this->pubConfig = [
            __DIR__ . '/../../config/rsprLog.php' => config_path('../config/rsprLog.php')
        ];
    }
}
