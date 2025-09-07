<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonail extends Model
{
    use HasTranslations;
    protected $fillable = [
        "name",
        "position",
        "description",
        "image",
        "status"
    ];
    public $translatable = ["position", "name", "description"];
}
