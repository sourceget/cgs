<?php

namespace Modules\Workflow\Repositories;

use App\Repositories\SupperRepository;
use Modules\Workflow\Entities\WorkFlow;

class WorkFlowRepository extends SupperRepository {

    public function model() {
        return WorkFlow::class;
    }
}
