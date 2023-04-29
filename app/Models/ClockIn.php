<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClockIn extends Model
{
    use HasFactory, HasFactory;
    protected $fillable = ['latitude' , 'longitude' , 'worker_id' ];
    const IN = "in";
    const OUT = "out";
    const TYPES = [self::IN , self::OUT  ];
    public function worker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }



}
