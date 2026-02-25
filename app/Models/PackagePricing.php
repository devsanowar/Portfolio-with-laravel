<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagePricing extends Model
{
    protected $guarded = ['id'];

    public function service(){
       return $this->belongsTo(Service::class);
    }

    protected $casts = [
        'features' => 'array',
    ];
}
