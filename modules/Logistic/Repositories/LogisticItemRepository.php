<?php

namespace Modules\Logistic\Repositories;

use App\Repositories\SupperRepository;
use Modules\Logistic\Entities\LogisticItem;

class LogisticItemRepository extends SupperRepository {

    public function model() {
        return LogisticItem::class;
    }

}
