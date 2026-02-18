<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order', 'asc')->latest()->get();
        return view('admin.layouts.pages.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.layouts.pages.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_title' => ['required', 'string', 'max:255'],
            'icon_class'    => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string'],
            'project_url'   => ['nullable', 'string'],
            'tools'         => ['required', 'string'],
            'sort_order'    => ['nullable', 'integer', 'min:0'],
            'status'        => ['required', 'in:0,1'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $project            = Project::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Project created successfully!',
            'data'    => $project,
        ]);
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.layouts.pages.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'project_title' => ['required', 'string', 'max:255'],
            'icon_class'    => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string'],
            'tools'         => ['required', 'string'],
            'sort_order'    => ['nullable', 'integer', 'min:0'],
            'status'        => ['required', 'in:0,1'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;

        DB::transaction(function () use ($data, $id) {

            $project = Project::lockForUpdate()->findOrFail($id);
            $oldOrder = (int) $project->sort_order;
            $newOrder = (int) $data['sort_order'];

            if ($newOrder !== $oldOrder) {

                $other = Project::where('id', '!=', $project->id)
                    ->where('sort_order', $newOrder)
                    ->lockForUpdate()
                    ->first();

                if ($other) {
                    $temp = -999999;
                    while (Project::where('sort_order', $temp)->exists()) {
                        $temp--;
                    }
                    $project->update(['sort_order' => $temp]);
                    $other->update(['sort_order' => $oldOrder]);
                    $project->update(['sort_order' => $newOrder]);
                } else {
                    $project->update(['sort_order' => $newOrder]);
                }
            }
            $project->update(collect($data)->except('sort_order')->toArray());
        });

        return response()->json([
            'status'     => 'success',
            'message'    => 'Project updated successfully!',
            'action_url' => route('admin.project.index'),
        ]);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.project.index')->with('success', 'Project deleted successfully!');
    }
}
