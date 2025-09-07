<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AboutUs extends Model
{
    use HasTranslations;
    protected $fillable = [
        "title",
        "description",
        "type",
    ];
    public $translatable = ['title', 'description'];
    public function aboutImages(){
        return $this->hasMany(AboutImage::class);
    }

}
