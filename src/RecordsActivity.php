<?php

namespace Minhajul\ActivityLogger;

use ReflectionClass;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        if (isset(static::$recordEvents)){
            return static::$recordEvents;
        }

        $events = [
            'created', 'updated' , 'deleted'
        ];

        if (array_has(class_uses_recursive(static::class), SoftDeletes::class)){
            array_push($events, 'restored');
        }

        return $events;
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'loggable');
    }

    public function activity()
    {
        return $this->hasMany(Activity::class, 'user_id');
    }
}