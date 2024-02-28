<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function gorod_vileta()
    {
        return $this->belongsTo(ViletCity::class,'vilet_city_id');
    }

    public function category()
    {
        return $this->belongsTo(TourCategory::class,'category_id');
    }
}
