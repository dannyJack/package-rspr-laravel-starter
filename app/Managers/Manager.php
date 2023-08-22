<?php

namespace App\Managers;

use App\Repositories\Repository;
use App\Responses\Manager\ManagerResponse;

class Manager
{
    public Repository $repository;

    public function response(): ManagerResponse
    {
        return new ManagerResponse();
    }
}
