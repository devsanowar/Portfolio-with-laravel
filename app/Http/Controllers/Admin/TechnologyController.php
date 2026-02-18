<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Service;
use App\Models\Technology;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::select('id', 'service_name')
            ->orderBy('service_name')
            ->get();
        $technologies = Technology::with(['service:id,service_name'])->latest()->get();
        return view('admin.layouts.pages.services.technology.index', compact('technologies', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $data = $request->validated();
        Technology::create($data);
        return redirect()->back()->with('success', 'Technology added successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $technology = Technology::findOrFail($id);

            $data = $request->validated();

            $oldOrder = $technology->sort_order;
            $newOrder = $data['sort_order'] ?? null;

            if ($newOrder !== null && (int) $newOrder !== (int) $oldOrder) {

                $other = Technology::where('id', '!=', $technology->id)
                    ->where('sort_order', $newOrder)
                    ->lockForUpdate()
                    ->first();

                if ($other) {
                    $temp = -999999;
                    while (Technology::where('sort_order', $temp)->exists()) {
                        $temp--;
                    }

                    $technology->sort_order = $temp;
                    $technology->save();

                    $other->sort_order = $oldOrder;
                    $other->save();
                }
            }

            $technology->update($data);

            DB::commit();

            return response()->json([
                'status'     => 'success',
                'message'    => 'Technology updated successfully!',
                'action_url' => route('admin.technology.index'),
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
            $feature = Technology::findOrFail($id);
            $feature->delete();

            return redirect()->route('admin.technology.index')->with('success', 'Technology deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Technology Delete Error: ' . $e->getMessage());
            return redirect()->route('admin.technology.index')->with('error', 'Failed to delete Technology. Please try again.');
        }
    }
}
