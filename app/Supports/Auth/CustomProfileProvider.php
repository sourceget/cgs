<?php

namespace App\Supports\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class CustomProfileProvider extends EloquentUserProvider {

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials) {
        $query = $this->createModel()->newQuery();
        return $query->first();
    }

    public function validateCredentials(UserContract $user, array $credentials) {

        $plain = $credentials['password'];

        if (!count($user->password)) {
            return false;
        }

        $authPassword = $user->password[0]->content;

        return $authPassword === $this->hasher->check($plain, $authPassword);
    }

}
