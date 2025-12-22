<?php
namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SkillsStoreRequest;
use App\Http\Requests\SkillsUpdateRequest;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::with('category')
            ->orderBy('sort_order', 'asc')
            ->get();
        return view('admin.layouts.pages.home.skills-section.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = SkillCategory::where('status', 1)->get();
        return view('admin.layouts.pages.home.skills-section.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillsStoreRequest $request)
    {
        $data = $request->validated();

        // type casting / safety
        $data['skill_category_id'] = (int) $data['skill_category_id'];
        $data['percentage']        = (int) $data['percentage'];
        $data['sort_order']        = (int) ($data['sort_order'] ?? 0);
        $data['status']            = (int) ($data['status'] ?? 0);

        try {
            $skill = DB::transaction(function () use ($data) {
                return Skill::create($data);
            });

            return response()->json([
                'status'  => 'success',
                'message' => 'Skill created successfully.',
                'data'    => $skill->load('category'),
            ], 201);

        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to create skill. Please try again.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $skill      = Skill::findOrFail($id);
        $categories = SkillCategory::where('status', 1)->orderBy('sort_order')->get();

        return view('admin.layouts.pages.home.skills-section.edit', compact('skill', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SkillsUpdateRequest $request, string $id)
    {
        $skill = Skill::findOrFail($id);

        $data = $request->validated();

        // type casting / safety
        $data['skill_category_id'] = (int) $data['skill_category_id'];
        $data['percentage']        = (int) $data['percentage'];
        $data['sort_order']        = (int) ($data['sort_order'] ?? 0);
        $data['status']            = (int) $data['status'];

        try {
            DB::transaction(function () use ($skill, $data) {
                $skill->update($data);
            });

            return response()->json([
                'status'  => 'success',
                'message' => 'Skill updated successfully.',
                'data'    => $skill->fresh()->load('category'),
            ], 200);

        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to update skill. Please try again.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Skills deleted successfully.');
    }
}
