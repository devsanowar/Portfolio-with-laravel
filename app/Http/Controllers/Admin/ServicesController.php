<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order', 'asc')
            ->latest()
            ->get();

        return view('admin.layouts.pages.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.layouts.pages.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_name'       => ['required', 'string', 'max:255'],
            'service_slug'       => ['nullable', 'string', 'max:255', 'unique:services,service_slug'],
            'icon_class'         => ['required', 'string', 'max:255'],

            'short_description'  => ['required', 'string'],
            'long_description'   => ['required', 'string'],

            'delivery_time'      => ['nullable', 'string', 'max:255'],
            'features'           => ['nullable', 'string'], // longText

            'complete_project'   => ['nullable', 'string', 'max:255'], // default '0'
            'rating'             => ['nullable', 'string', 'max:255'],

            'button_one'         => ['nullable', 'string', 'max:255'],
            'button_one_url'     => ['nullable', 'string'], // text
            'button_two'         => ['nullable', 'string', 'max:255'],
            'button_two_url'     => ['nullable', 'string'], // text

            'sort_order'         => ['nullable', 'integer'],
            'status'             => ['nullable', Rule::in([0, 1])],
        ]);

        // slug: required in DB, so ensure always set
        $slug = $validated['service_slug'] ?? Str::slug($validated['service_name']);
        if (Service::where('service_slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        $service = Service::create([
            'service_name'       => $validated['service_name'],
            'service_slug'       => $slug,
            'icon_class'         => $validated['icon_class'],

            'short_description'  => $validated['short_description'],
            'long_description'   => $validated['long_description'],

            'delivery_time'      => $validated['delivery_time'] ?? null,
            'features'           => $validated['features'] ?? null,

            'complete_project'   => $validated['complete_project'] ?? '0',
            'rating'             => $validated['rating'] ?? null,

            'button_one'         => $validated['button_one'] ?? null,
            'button_one_url'     => $validated['button_one_url'] ?? null,
            'button_two'         => $validated['button_two'] ?? null,
            'button_two_url'     => $validated['button_two_url'] ?? null,

            'sort_order'         => $validated['sort_order'] ?? 0,
            'status'             => $validated['status'] ?? 0,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Service created successfully.',
                'data'    => $service,
            ]);
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.layouts.pages.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'service_name'       => ['required', 'string', 'max:255'],
            'service_slug'       => [
                'nullable', 'string', 'max:255',
                Rule::unique('services', 'service_slug')->ignore($service->id),
            ],
            'icon_class'         => ['required', 'string', 'max:255'],

            'short_description'  => ['required', 'string'],
            'long_description'   => ['required', 'string'],

            'delivery_time'      => ['nullable', 'string', 'max:255'],
            'features'           => ['nullable', 'string'],

            'complete_project'   => ['nullable', 'string', 'max:255'],
            'rating'             => ['nullable', 'string', 'max:255'],

            'button_one'         => ['nullable', 'string', 'max:255'],
            'button_one_url'     => ['nullable', 'string'],
            'button_two'         => ['nullable', 'string', 'max:255'],
            'button_two_url'     => ['nullable', 'string'],

            'sort_order'         => ['nullable', 'integer'],
            'status'             => ['nullable', Rule::in([0, 1])],
        ]);

        // slug: if empty, generate from name; always keep unique
        $slug = $validated['service_slug'] ?? Str::slug($validated['service_name']);
        $slugExists = Service::where('service_slug', $slug)
            ->where('id', '!=', $service->id)
            ->exists();

        if ($slugExists) {
            $slug = $slug . '-' . time();
        }

        $service->update([
            'service_name'       => $validated['service_name'],
            'service_slug'       => $slug,
            'icon_class'         => $validated['icon_class'],

            'short_description'  => $validated['short_description'],
            'long_description'   => $validated['long_description'],

            'delivery_time'      => $validated['delivery_time'] ?? null,
            'features'           => $validated['features'] ?? null,

            'complete_project'   => $validated['complete_project'] ?? '0',
            'rating'             => $validated['rating'] ?? null,

            'button_one'         => $validated['button_one'] ?? null,
            'button_one_url'     => $validated['button_one_url'] ?? null,
            'button_two'         => $validated['button_two'] ?? null,
            'button_two_url'     => $validated['button_two_url'] ?? null,

            'sort_order'         => $validated['sort_order'] ?? 0,
            'status'             => $validated['status'] ?? 0,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Service updated successfully.',
                'data'    => $service,
            ]);
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        if ($request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Service deleted successfully.',
            ]);
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
