<?php

namespace Modules\Logistic\Repositories;

use App\Repositories\SupperRepository;
use Modules\Logistic\Entities\LogisticInfo;

class LogisticInfoRepository extends SupperRepository {

    public function model() {
        return LogisticInfo::class;
    }

    public function log($logisticId, $no, $data) {
        $ret = $this->findOneBy('no', $no);
        if (!$ret) {
            $ret = $this->create([
                'logistic_id' => $logisticId,
                'no' => $no,
                'updated_at' => '2010-01-01 00:00:00'
            ]);
        }
        $ret->updateLogistic($ret->id, $data);
    }

}
