<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\HeroSection;

class HomeController extends Controller
{
    public function index(){
        $hero = HeroSection::first();
        $about = AboutSection::first();
        return view('website.layouts.pages.home', compact(
            'hero',
            'about',

        ));
    }
}
