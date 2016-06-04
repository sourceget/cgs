<?php

namespace Modules\Department\Repositories;

use App\Repositories\SupperRepository;
use Modules\Department\Entities\Department;

class DepartmentRepository extends SupperRepository {

    public function model() {
        return Department::class;
    }
}
