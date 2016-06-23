<?php

namespace Modules\Logistic\Repositories;

use App\Repositories\SupperRepository;
use Modules\Logistic\Entities\Logistic;

class LogisticRepository extends SupperRepository {

    public function model() {
        return Logistic::class;
    }
}
