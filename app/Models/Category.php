<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasTranslations;
    protected $fillable = ["parent_id", "name", "description", "image", "status"];
    public $translatable = ['name', 'description'];

    public function parentCategory()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id')->where('status', 1);
    }
    public function tests(){
        return $this->hasMany(Test::class);
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    }

    public static function getCategories($type = null)
    {
        $query = Category::with(['subCategories'])
            ->where('parent_id', 0)
            ->where('status', 1);

        if ($type) {
            if (is_array($type)) {
                $query->whereIn('type', $type);
            } else {
                $query->where('type', $type);
            }
        }

        return $query->get();
    }
}
