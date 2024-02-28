<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function city()
    {
        return $this->belongsTo(WorkCity::class, 'city_id');
    }
}
