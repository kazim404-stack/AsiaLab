<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasTranslations;
    protected $fillable = [
        "category_id",
        "unite",
        "refrence",
        "name",
        "description"
    ];
    public $translatable = ['name', 'description'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function testImages(){
        return $this->hasMany(TestImage::class);
    }
}
