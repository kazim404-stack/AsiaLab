<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Province extends Model
{
    use HasTranslations;

    protected $fillable = [
        'province',
    ];
    public $translatable = ['province'];
    public function contacts(){
        return $this->hasMany(Contact::class);
    }
}
