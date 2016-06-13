<?php

namespace Modules\Baidu\Repositories;

use App\Repositories\SupperRepository;
use Modules\Baidu\Entities\Baidu;

class BaiduRepository extends SupperRepository {

    public function model() {
        return Baidu::class;
    }
}
