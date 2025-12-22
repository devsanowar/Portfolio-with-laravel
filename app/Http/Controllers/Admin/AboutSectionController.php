<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAboutSectionRequest;
use App\Models\AboutSection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AboutSectionController extends Controller
{
    public function aboutSection()
    {
        $about = AboutSection::first();
        return view('admin.layouts.pages.home.about-section.index', compact('about'));
    }

    public function aboutSectionUpdate(UpdateAboutSectionRequest $request)
    {
        $about = AboutSection::first() ?? new AboutSection();

        $data = $request->only([
            'title',
            'description',
            'experience',
            'projects',
        ]);

        $skills = $request->input('skills', []);
        $skills = array_values(array_filter(array_map('trim', $skills))); // empty বাদ

        $data['skills'] = ! empty($skills) ? json_encode($skills) : null;

        $uploadDir = public_path('uploads/about');
        if (! File::exists($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true, true);
        }

        // Image upload
        if ($request->hasFile('image')) {
            if (! empty($about->image) && File::exists(public_path($about->image))) {
                File::delete(public_path($about->image));
            }

            $img     = $request->file('image');
            $imgName = 'about_' . Str::random(12) . '_' . time() . '.' . $img->getClientOriginalExtension();
            $img->move($uploadDir, $imgName);

            $data['image'] = 'uploads/about/' . $imgName;
        }

        // PDF upload
        if ($request->hasFile('pdf')) {
            if (! empty($about->pdf) && File::exists(public_path($about->pdf))) {
                File::delete(public_path($about->pdf));
            }

            $pdf     = $request->file('pdf');
            $pdfName = 'about_' . Str::random(12) . '_' . time() . '.' . $pdf->getClientOriginalExtension();
            $pdf->move($uploadDir, $pdfName);

            $data['pdf'] = 'uploads/about/' . $pdfName;
        }

        $about->fill($data);
        $about->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'About section updated successfully.',
            'data'    => $about,
        ]);
    }

}
