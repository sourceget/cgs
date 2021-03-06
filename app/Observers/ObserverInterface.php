<?php

namespace App\Core\Observers;

use Illuminate\Database\Eloquent\Model;

interface ObserverInterface {

    public function creating(Model $model);

    public function created(Model $model);

    public function saving(Model $model);

    public function saved(Model $model);

    public function updating(Model $model);

    public function updated(Model $model);

    public function deleting(Model $model);

    public function deleted(Model $model);

    public function restoring(Model $model);

    public function restored(Model $model);
}
