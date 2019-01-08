<?php

namespace Minhajul\ActivityLog;

use ReflectionClass;
use Minhajul\ActivityLog\Models\ActivityLog;

trait ActivityLogTrait
{
    protected static function boot()
    {
        parent::boot();

        foreach (static::getModelEvents() as $event){
            static::$event(function ($model) use ($event){
                self::storeActivity($model, $event);
            });
        }
    }

    protected static function getActivityName($model, $event)
    {
        $name = (new ReflectionClass($model))->getShortName();
        return $event.'_'. snake_case($name);
    }

    protected static function storeActivity($model, $event)
    {
        $activityLog = new ActivityLog();
        $activityLog->cause = self::getActivityName($model, $event);
        $model->activities()->save($activityLog);
    }

    protected static function getModelEvents()
    {
        if (isset(static::$recordsEvent)){
            return static::$recordsEvent;
        }

        return [
            'created', 'updated' , 'deleted'
        ];
    }

    protected function activities()
    {
        return $this->morphMany(ActivityLog::class, 'loggable');
    }
}