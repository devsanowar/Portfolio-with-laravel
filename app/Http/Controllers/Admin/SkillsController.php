<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkillSection;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function index()
    {
        $skills = SkillSection::latest()->get();
        return view('admin.layouts.pages.home.skills-section.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.layouts.pages.home.skills-section.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'skill_name' => 'required|string|max:255',
            'skill_value' => 'required|integer|min:0|max:100',
            'status' => 'required|in:0,1',
        ]);

        SkillSection::create([
            'skill_name' => $request->skill_name,
            'skill_value' => $request->skill_value,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Skill added successfully'
        ]);
    }

    public function edit($id)
    {
        $skill = SkillSection::findOrFail($id);
        return view('admin.layouts.pages.home.skills-section.edit', compact('skill'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'skill_name' => 'required|string|max:255',
            'skill_value' => 'required|integer|min:0|max:100',
            'status' => 'required|in:0,1',
        ]);

        $skill = SkillSection::findOrFail($id);
        $skill->update([
            'skill_name' => $request->skill_name,
            'skill_value' => $request->skill_value,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Skill updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $skill = SkillSection::findOrFail($id);
        $skill->delete();

        return redirect()->back()->with('success', 'Skill deleted successfully');
    }
}
