<?php
namespace App\Http\Controllers\Admin;

use App\Models\KeyFeature;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\KeyFeatureStoreRequest;
use App\Http\Requests\KeyFeatureUpdateRequest;

class KeyFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keyFeatures = KeyFeature::orderBy('sort_order', 'asc')->get();
        return view('admin.layouts.pages.services.key-feature.index', compact('keyFeatures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layouts.pages.services.key-feature.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KeyFeatureStoreRequest $request)
    {
        try {
            $data = $request->validated();

            // KeyFeature create
            $feature = KeyFeature::create($data);

            return response()->json([
                'status'  => 'success',
                'message' => 'Key Feature created successfully!',
                'data'    => $feature,
            ]);

        } catch (\Exception $e) {
            Log::error('KeyFeature Store Error: ' . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to create Key Feature. Please try again.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feature = KeyFeature::findOrFail($id);
        return view('admin.layouts.pages.services.key-feature.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KeyFeatureUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $feature  = KeyFeature::findOrFail($id);
            $newOrder = $request->sort_order;

            if ($newOrder !== null) {

                $exists = KeyFeature::where('id', '!=', $feature->id)
                    ->where('sort_order', $newOrder)
                    ->exists();

                if ($exists) {
                    KeyFeature::where('id', '!=', $feature->id)
                        ->where('sort_order', '>=', $newOrder)
                        ->increment('sort_order');
                }
            }

            $feature->update($request->validated());

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => 'Key Feature updated successfully!',
                'action_url' => route('admin.key-feature.index'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $feature = KeyFeature::findOrFail($id);
            $feature->delete();

            return redirect()->route('admin.key-feature.index')->with('success', 'Key Feature deleted successfully.');

        } catch (\Exception $e) {
            Log::error('KeyFeature Delete Error: ' . $e->getMessage());
            return redirect()->route('admin.key-feature.index')->with('error', 'Failed to delete Key Feature. Please try again.');
        }
    }
}
