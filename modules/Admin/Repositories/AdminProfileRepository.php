<?php

namespace Modules\Admin\Repositories;

use App\Repositories\SupperRepository;
use Modules\Admin\Entities\AdminProfile;

class AdminProfileRepository extends SupperRepository {

    public function model() {
        return AdminProfile::class;
    }
}
