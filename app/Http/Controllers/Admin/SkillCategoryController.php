<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillCategoryStoreRequest;
use App\Http\Requests\SkillCategoryUpdateRequest;
use App\Models\SkillCategory;
use Illuminate\Support\Facades\DB;
use Throwable;

class SkillCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = SkillCategory::latest()->get();
        return view('admin.layouts.pages.home.skills-section.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layouts.pages.home.skills-section.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillCategoryStoreRequest $request)
    {
        $payload = $request->validated();

        // type casting (DB expects bool/int)
        $payload['status']     = (int) $payload['status'];
        $payload['sort_order'] = (int) ($payload['sort_order'] ?? 0);

        try {
            $category = DB::transaction(function () use ($payload) {
                return SkillCategory::create($payload);
            });

            return response()->json([
                'status'  => 'success',
                'message' => 'Skill category created successfully.',
                'data'    => $category,
            ], 201);

        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to create category. Please try again.',
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
        $category = SkillCategory::find($id);
        return view('admin.layouts.pages.home.skills-section.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SkillCategoryUpdateRequest $request, string $id)
    {
        $category = SkillCategory::findOrFail($id);

        $data = $request->validated();

        // type casting / defaults
        $data['status']     = (int) ($data['status'] ?? 0);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        try {
            DB::transaction(function () use ($category, $data) {
                $category->update($data);
            });

            return response()->json([
                'status'  => 'success',
                'message' => 'Category updated successfully.',
                'data'    => $category->fresh(),
            ], 200);

        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to update category. Please try again.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = SkillCategory::findOrFail($id);
        $category->delete();

        return redirect()
            ->route('admin.skills.category.index')
            ->with('success', 'Category deleted successfully.');
    }
}
