<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateHeroSectionRequest;
use App\Models\HeroSection;

class HeroSectionController extends Controller
{
    public function heroSection()
    {
        $heroSection = HeroSection::first();
        return view('admin.layouts.pages.home.hero-section.index', compact('heroSection'));
    }

    public function heroSectionUpdate(UpdateHeroSectionRequest $request)
    {
        $hero = HeroSection::firstOrCreate([]);

        $data = $request->validated();

        // Allow only schema fields (extra safety)
        $payload = collect($data)->only([
            'title',
            'sub_title',
            'description',
            'github_url',
            'facebook_url',
            'instagram_url',
            'linkedin_url',
            'pinterest_url',
            'medium_url',
            'dribble_url',
        ])->toArray();

        // Normalize (optional): trim strings + convert empty to null
        $payload = array_map(function ($value) {
            if (is_string($value)) {
                $value = trim($value);
                return $value === '' ? null : $value;
            }
            return $value;
        }, $payload);

        $hero->update($payload);

        return response()->json([
            'status'  => 'success',
            'message' => 'Hero section updated successfully.',
            'data'    => $hero->only(array_keys($payload)),
        ]);
    }

}
