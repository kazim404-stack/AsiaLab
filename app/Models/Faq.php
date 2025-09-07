<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasTranslations;
    protected $fillable = [
        'question',
        'answear',
        'status',
    ];
    public $translatable = ["question", "answear"];
}
