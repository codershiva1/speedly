<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait Loggable
{
    public static function bootLoggable()
    {
        static::created(function ($model) {
            ActivityLog::log('created', "Created " . class_basename($model), $model, $model->toArray());
        });

        static::updated(function ($model) {
            $changed = $model->getDirty();
            ActivityLog::log('updated', "Updated " . class_basename($model), $model, [
                'old' => array_intersect_key($model->getOriginal(), $changed),
                'new' => $changed,
            ]);
        });

        static::deleted(function ($model) {
            ActivityLog::log('deleted', "Deleted " . class_basename($model), $model, $model->toArray());
        });
    }
}
