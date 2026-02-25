<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // 1) Index: list
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();

        return view('admin.layouts.pages.faq.index', compact('faqs'));
    }

    // 2) Create: form
    public function create()
    {
        return view('admin.layouts.pages.faq.create');
    }

    // 3) Store: Ajax POST
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => ['required', 'string'],
            'answer'   => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status'   => ['required', 'in:0,1'],
        ]);

        $faq = Faq::create([
            'question' => $validated['question'],
            'answer'   => $validated['answer'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'status'   => $validated['status'],
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'FAQ created successfully.',
            'data'    => $faq,
        ], 201);
    }

    // 4) Edit: form
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.layouts.pages.faq.edit', compact('faq'));
    }

    // 5) Update: Ajax POST (id ধরে)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => ['required', 'string'],
            'answer'   => ['required', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status'   => ['required', 'in:0,1'],
        ]);

        $faq = Faq::findOrFail($id);

        $faq->update([
            'question' => $validated['question'],
            'answer'   => $validated['answer'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'status'   => $validated['status'],
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'FAQ updated successfully.',
            'data'    => $faq,
        ]);
    }

    // 6) Destroy: delete (SweetAlert theke)
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'FAQ deleted successfully.',
        ]);
    }
}
