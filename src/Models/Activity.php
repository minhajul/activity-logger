<?php

namespace Minhajul\ActivityLogger\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activity_logs';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function loggable()
    {
        return $this->morphTo();
    }

    public function causedBy()
    {
        if (class_exists('\App\User')){
            return $this->belongsTo('App\User', 'user_id');
        }elseif (class_exists('\App\Models\User')){
            return $this->belongsTo('App\Models\User', 'user_id');
        }else {
            return null;
        }
    }

}
