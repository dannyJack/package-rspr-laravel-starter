<?php

namespace App\Models;

use App\Traits\Model\ModelTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ModelAuthenticatable extends Authenticatable
{
    use ModelTrait;

    /**
     * @var $appends
     */
    protected $appends = [
        'id',
        'isEmpty',
        'isNotEmpty',
    ];
}
