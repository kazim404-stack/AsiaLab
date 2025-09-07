<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutImage extends Model
{
    protected $fillable = [
        "about_us_id",
        "image"
    ];
    public function about()
    {
        return $this->belongsTo(AboutUs::class, 'about_us_id');
    }
}
