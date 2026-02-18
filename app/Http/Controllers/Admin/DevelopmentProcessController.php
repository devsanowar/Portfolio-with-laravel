<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DevelopmentProcess;
use App\Models\Service;
use Illuminate\Http\Request;

class DevelopmentProcessController extends Controller
{
    public function index()
    {
        $services = Service::select('id', 'service_name')
            ->orderBy('service_name')
            ->get();
        $processes = DevelopmentProcess::with(['service:id,service_name'])->latest()->get();
        return view('admin.layouts.pages.services.development_process.index', compact('processes', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => ['nullable', 'integer', 'exists:services,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status'      => ['nullable', 'integer', 'in:0,1'],
        ]);

        DevelopmentProcess::create([
            'service_id'  => $validated['service_id'],
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'status'      => (int) ($validated['status'] ?? 0),
        ]);

        return redirect()
            ->route('admin.development_process.index')
            ->with('success', 'Development process created successfully.');
    }

    public function update(Request $request, DevelopmentProcess $development_process)
    {
        $validated = $request->validate([
            'service_id' => ['nullable', 'integer', 'exists:services,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status'      => ['nullable', 'integer', 'in:0,1'],
        ]);

        $development_process->update([
            'service_id'       => $validated['service_id'],
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'status'      => (int) ($validated['status'] ?? 0),
        ]);

        return response()->json([
            'status'     => 'success',
            'message'    => 'Updated successfully.',
            'action_url' => route('admin.development_process.index'),
        ]);
    }

    public function destroy(DevelopmentProcess $development_process)
    {
        $development_process->delete();

        return redirect()
            ->route('admin.development_process.index')
            ->with('success', 'Deleted successfully.');
    }
}
