<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function photo()
    {
        return $this->hasmany(HotelPhoto::class,'hotel_id')->orderby('id', 'desc');
    }
}
