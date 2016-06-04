<?php

namespace App\Entities;

use Chrisbjr\ApiGuard\Models\ApiKey as Key;

class ApiKey extends Key
{
    protected $table = 'api_key';

}
