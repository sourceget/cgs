<?php

namespace App\Repositories;

use App\Repositories\SupperRepository;
use App\Entities\User;

class UserRepository extends SupperRepository {

    public function model() {
        return User::class;
    }
}
