<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DevelopmentProcess;
use App\Http\Controllers\Controller;

class DevelopmentProcessController extends Controller
{
    public function index()
    {
        $processes = DevelopmentProcess::latest()->get();
        return view('admin.layouts.pages.services.development_process.index', compact('processes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required','string','max:255'],
            'description' => ['required','string'],
            'status'      => ['nullable','integer','in:0,1'],
        ]);

        DevelopmentProcess::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'status'      => (int)($validated['status'] ?? 0),
        ]);

        return redirect()
            ->route('admin.development-processes.index')
            ->with('success', 'Development process created successfully.');
    }

    public function update(Request $request, DevelopmentProcess $development_process)
    {
        $validated = $request->validate([
            'title'       => ['required','string','max:255'],
            'description' => ['required','string'],
            'status'      => ['nullable','integer','in:0,1'],
        ]);

        $development_process->update([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'status'      => (int)($validated['status'] ?? 0),
        ]);

        // Modal edit e AJAX diye submit korte chaile JSON return korte paro
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Updated successfully.',
                'action_url' => route('admin.development-processes.index'),
            ]);
        }

        return redirect()
            ->route('admin.development-processes.index')
            ->with('success', 'Development process updated successfully.');
    }

    public function destroy(DevelopmentProcess $development_process)
    {
        $development_process->delete();

        return redirect()
            ->route('admin.development-processes.index')
            ->with('success', 'Deleted successfully.');
    }
}
