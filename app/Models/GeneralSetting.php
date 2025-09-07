<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class GeneralSetting extends Model
{
    use HasTranslations;
    protected $fillable = [
        "site_name",
        "logo",
        "x",
        "linkedin",
        "facebook",
        "instagram",
        "whatsapp",
        "youtube",
        "telegram",
    ];
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
