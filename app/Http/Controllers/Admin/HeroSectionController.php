<?php

namespace App\Http\Controllers\Admin;

use App\Models\HeroSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdateHeroSectionRequest;

class HeroSectionController extends Controller
{
    public function heroSection(){
        $heroSection = HeroSection::first();
        return view('admin.layouts.pages.home.hero-section.index', compact('heroSection'));
    }


    public function heroSectionUpdate(UpdateHeroSectionRequest $request)
    {
        // single row ধরে নেওয়া হয়েছে
        $hero = HeroSection::first();

        if (! $hero) {
            $hero = new HeroSection();
        }

        // validated data
        $data = $request->only([
            'title',
            'sub_title',
            'description',
            'button_text',
            'button_url',
            'button_text_two',
            'button_url_two',
        ]);

        // -----------------------------
        // Hero Image handle
        // -----------------------------
        if ($request->hasFile('image')) {
            // পুরনো image থাকলে ডিলিট করবো
            if ($hero->image && File::exists(public_path($hero->image))) {
                File::delete(public_path($hero->image));
            }

            $image      = $request->file('image');
            $imageName  = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
            $imagePath  = 'uploads/hero/'.$imageName;

            $image->move(public_path('uploads/hero'), $imageName);

            $data['image'] = $imagePath;
        }

        // -----------------------------
        // PDF handle
        // -----------------------------
        if ($request->hasFile('pdf')) {
            if ($hero->pdf && File::exists(public_path($hero->pdf))) {
                File::delete(public_path($hero->pdf));
            }

            $pdf      = $request->file('pdf');
            $pdfName  = time().'_'.uniqid().'.'.$pdf->getClientOriginalExtension();
            $pdfPath  = 'uploads/hero/'.$pdfName;

            $pdf->move(public_path('uploads/hero'), $pdfName);

            $data['pdf'] = $pdfPath;
        }

        // ডাটাবেজে save
        $hero->fill($data);
        $hero->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Hero section updated successfully.',
            'data'    => [
                'image' => $hero->image ? asset($hero->image) : null,
                'pdf'   => $hero->pdf ? asset($hero->pdf) : null,
            ],
        ]);
    }


}
