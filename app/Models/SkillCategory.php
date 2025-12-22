<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillCategory extends Model
{
    protected $guarded = ['id'];


    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    
}
