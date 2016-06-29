<?php

namespace Modules\V1\Repositories;

use App\Repositories\SupperRepository;
use Modules\V1\Entities\V1;

class V1Repository extends SupperRepository {

    public function model() {
        return V1::class;
    }
}
