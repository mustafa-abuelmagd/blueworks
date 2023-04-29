<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory, HasFactory;

    protected $table = 'workers';
//    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];

    public function clockIns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClockIn::class);
    }

}
