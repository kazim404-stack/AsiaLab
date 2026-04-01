<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Contact extends Model
{
    use HasTranslations;
    protected $fillable = [
        "general_setting_id",
        "province_id",
        "email",
        "state",
        "video_links",
        'address',
        'status',
    ];
    public $translatable = ['address','state'];
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
    public function generalSetting()
    {
        return $this->belongsTo(GeneralSetting::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function galleries(){
        return $this->hasMany(Gallery::class);
    }
}
