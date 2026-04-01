<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gallery extends Model
{
    use HasTranslations;
    protected $fillable = ['contact_id', 'image'];
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
