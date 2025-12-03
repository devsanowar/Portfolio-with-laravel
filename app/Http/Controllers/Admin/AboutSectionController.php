<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAboutSectionRequest;

class AboutSectionController extends Controller
{
    public function aboutSection(){
        $about = AboutSection::first();
        return view('admin.layouts.pages.home.about-section.index', compact('about'));
    }


    public function aboutSectionUpdate(UpdateAboutSectionRequest $request)
    {
        // Single row about section
        $about = AboutSection::first();

        if (! $about) {
            $about = new AboutSection();
        }

        $data = $request->only([
            'section_title',
            'section_subtitle',
            'description',
            'name',
            'father_name',
            'mother_name',
            'date_of_birth',
            'age',
            'gender',
            'email',
            'phone',
            'address',
        ]);

        $about->fill($data);
        $about->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'About section updated successfully.',
            'data'    => $about,
        ]);
    }
}
