<?php
namespace App\Models;

use App\Models\SkillCategory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(SkillCategory::class, 'skill_category_id');
    }

    protected $casts = [
        'percentage' => 'integer',
        'sort_order' => 'integer',
        'status'     => 'boolean',
    ];

}
