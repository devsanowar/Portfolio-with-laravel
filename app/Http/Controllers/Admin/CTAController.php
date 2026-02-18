<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CTA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CTAController extends Controller
{
    public function edit()
    {
        $cta = CTA::first(); // may be null
        return view('admin.layouts.pages.cta.edit', compact('cta'));
    }

    public function save(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validate([
                'title'            => ['required', 'string', 'max:255'],
                'description'      => ['required', 'string'],
                'button_one_name'  => ['nullable', 'string', 'max:255'],
                'button_one_url'   => ['nullable', 'string', 'max:255'],
                'button_two_name'  => ['nullable', 'string', 'max:255'],
                'button_two_url'   => ['nullable', 'string'], // text column
                'status'           => ['required', 'in:0,1'],
            ]);

            $cta = CTA::first();

            if ($cta) {
                $cta->update($data);
                $msg = 'CTA updated successfully!';
            } else {
                $cta = CTA::create($data);
                $msg = 'CTA created successfully!';
            }

            DB::commit();

            return response()->json([
                'status'     => 'success',
                'message'    => $msg,
                'data'       => $cta,
                'action_url' => route('admin.cta.edit'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
