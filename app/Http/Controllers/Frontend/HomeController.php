<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\CTA;
use App\Models\HeroSection;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;

class HomeController extends Controller
{
    public function index(){
        $hero = HeroSection::first();
        $about = AboutSection::first();
        $skills = Skill::with('category')
            ->where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $services = Service::where('status', 1)->orderBy('sort_order')->get();
        $cta = CTA::first();

        $projects = Project::where('status', 1)->orderBy('sort_order')->get();

        $posts = Post::with('category')->where('status', 1)->latest()->take(3)->get();

        return view('website.layouts.pages.home', compact(
            'hero',
            'about',
            'skills',
            'services',
            'cta',
            'projects',
            'posts'
        ));
    }
}
