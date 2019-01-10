<?php

namespace Minhajul\ActivityLogger;

use ReflectionClass;
use Minhajul\ActivityLogger\Models\Activity;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
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
        $activityLog = new Activity();
        $activityLog->name = self::getActivityName($model, $event);
        $activityLog->user_id = auth()->id();
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

    public function activities()
    {
        return $this->morphMany(Activity::class, 'loggable');
    }
}