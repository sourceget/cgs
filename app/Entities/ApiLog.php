<?php

namespace App\Entities;

use Chrisbjr\ApiGuard\Models\ApiLog as Log;
use App\Entities\ApiKey as Key;

class ApiLog extends Log {

    protected $table = 'api_log';
    protected $fillable = [
        'user_id',
        'api_key_id',
        'route',
        'method',
        'params',
        'ip_address',
    ];

    public static function create(array $attributes = []) {
        if (isset($attributes['api_key_id'])) {
            $apiKey = Key::find($attributes['api_key_id']);
            if ($apiKey) {
                $attributes['user_id'] = $apiKey['user_id'];
            }
        }
        return parent::create($attributes);
    }

}
