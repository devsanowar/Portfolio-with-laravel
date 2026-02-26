<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $guarded = ['id'];
    public function keyFeatures(): HasMany
    {
        return $this->hasMany(KeyFeature::class, 'service_id');
    }

    public function technologies(): HasMany
    {
        return $this->hasMany(Technology::class, 'service_id');
    }

    public function development_processes(): HasMany
    {
        return $this->hasMany(DevelopmentProcess::class, 'service_id');
    }

    protected $casts = [
        'features' => 'array',
    ];
}
