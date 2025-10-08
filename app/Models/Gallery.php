<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gallery extends Model
{
    use HasTranslations;
    protected $fillable = ['branch_name', 'image'];
    public $translatable = [
        'branch_name'
    ];
}
