<?php

namespace Modules\Admin\Repositories;

use App\Repositories\SupperRepository;
use Modules\Admin\Entities\Admin;

class AdminRepository extends SupperRepository {

    public function model() {
        return Admin::class;
    }
}
