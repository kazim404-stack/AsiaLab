<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    protected $fillable = [
        "slider_id",
        "type",
        "image",
    ];
    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
}
