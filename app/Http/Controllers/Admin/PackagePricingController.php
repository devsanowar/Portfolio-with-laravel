<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackagePricing;
use App\Models\Service;
use Illuminate\Http\Request;

class PackagePricingController extends Controller
{
    public function index()
    {
        $packagePricings = PackagePricing::with('service')
            ->orderBy('sort_order')
            ->get();
        return view('admin.layouts.pages.services.package-plan.index', compact('packagePricings'));
    }

    public function create()
    {
        $services = Service::where('status', 1)->latest()->get();
        return view('admin.layouts.pages.services.package-plan.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'name'       => ['required', 'string', 'max:255'],
            'price'      => ['required', 'numeric', 'min:0'],
            'features'   => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status'     => ['required', 'in:active,inactive', 'string'],
        ]);

        $features = null;
        if (! empty($validated['features'])) {
            $lines    = preg_split('/\r\n|\r|\n/', $validated['features']);
            $features = array_values(array_filter(array_map('trim', $lines)));
        }

        // Create
        $package = PackagePricing::create([
            'service_id' => $validated['service_id'],
            'name'       => $validated['name'],
            'price'      => $validated['price'],
            'features'   => $features,
            'sort_order' => $validated['sort_order'] ?? 0,
            'status'     => $validated['status'],
        ]);

        // Ajax JSON response
        return response()->json([
            'status'  => 'success',
            'message' => 'Package created successfully.',
            'data'    => $package,
        ], 201);
    }

    public function edit($id)
    {
        $packagePricing = PackagePricing::findOrFail($id); // id diye load
        $services       = Service::orderBy('sort_order')->get();

        return view('admin.layouts.pages.services.package-plan.edit', [
            'packagePricing' => $packagePricing,
            'services'       => $services,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'name'       => ['required', 'string', 'max:255'],
            'price'      => ['required', 'numeric', 'min:0'],
            'features'   => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status'     => ['required', 'in:active,inactive', 'string'],
        ]);

        // textarea -> array
        $features = null;
        if (! empty($validated['features'])) {
            $lines    = preg_split('/\r\n|\r|\n/', $validated['features']);
            $features = array_values(array_filter(array_map('trim', $lines)));
        }

        $packagePricing = PackagePricing::findOrFail($id);

        $packagePricing->update([
            'service_id' => $validated['service_id'],
            'name'       => $validated['name'],
            'price'      => $validated['price'],
            'features'   => $features,
            'sort_order' => $validated['sort_order'] ?? 0,
            'status'     => $validated['status'],
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Package updated successfully.',
            'data'    => $packagePricing->fresh('service'),
            'actionUrl' => route('admin.package_pricings.index')
        ]);
    }

    public function destroy($id){
        $packagePricing = PackagePricing::findOrFail($id);
        $packagePricing->delete();
        return redirect()->back()->with('success', 'Package Pricing deleted successfully>');
    }

}
