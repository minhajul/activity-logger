<?php

namespace Minhajul\ActivityLog\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
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

}
