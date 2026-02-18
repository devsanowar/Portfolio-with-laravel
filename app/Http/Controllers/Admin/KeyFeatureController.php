<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeyFeatureStoreRequest;
use App\Http\Requests\KeyFeatureUpdateRequest;
use App\Models\KeyFeature;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KeyFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keyFeatures = KeyFeature::with(['service:id,service_name'])->orderBy('sort_order', 'asc')->get();
        return view('admin.layouts.pages.services.key-feature.index', compact('keyFeatures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::select('id', 'service_name')
            ->orderBy('service_name')
            ->get();

        return view('admin.layouts.pages.services.key-feature.create', compact('services'));
    }

    public function store(KeyFeatureStoreRequest $request)
    {
        try {
            $data = $request->validated();

            // service_id nullable so empty string আসলে null করে দাও (safe)
            if (array_key_exists('service_id', $data) && $data['service_id'] === '') {
                $data['service_id'] = null;
            }

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

        $services = Service::select('id', 'service_name')
            ->orderBy('service_name')
            ->get();
        return view('admin.layouts.pages.services.key-feature.edit', compact('feature', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KeyFeatureUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $feature  = KeyFeature::findOrFail($id);
            $data     = $request->validated();
            $newOrder = $data['sort_order'] ?? null;

            // service_id nullable: empty string আসলে null করে দাও (select থেকে "" আসতে পারে)
            if (array_key_exists('service_id', $data) && $data['service_id'] === '') {
                $data['service_id'] = null;
            }

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

            $feature->update($data);

            DB::commit();

            return response()->json([
                'status'     => 'success',
                'message'    => 'Key Feature updated successfully!',
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
