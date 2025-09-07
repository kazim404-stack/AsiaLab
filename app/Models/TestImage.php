<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestImage extends Model
{
    protected $fillable = ['test_id', 'image'];
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
