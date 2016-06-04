<?php

namespace App\Http\Middleware;

use Chrisbjr\ApiGuard\Http\Middleware\ApiGuard as Guard;
use Closure;
use Illuminate\Http\Request;

class ApiGuard extends Guard {

    public function handle(Request $request, Closure $next, $serializedApiMethods = null) {
        
        if ($request->has(config('apiguard.keyName', 'X-Authorization'))) {
            $request->header(config('apiguard.keyName', 'X-Authorization'), $request->get(config('apiguard.keyName', 'X-Authorization')));
        }
        
        return parent::handle($request, $next, $serializedApiMethods);
    }

}
