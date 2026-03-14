<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmationMail;
use App\Mail\ContactMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:2|max:100',
        'email' => 'required|email|max:255',
        'subject' => 'required|min:3|max:200',
        'message' => 'required|min:10|max:1000'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ];

        Mail::to('sanowarwpneed@gmail.com')->send(new ContactMail($data));
        Mail::to($request->email)->send(new ConfirmationMail($data));

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully!'
        ]);
    } catch (\Exception $e) {
        \Log::error('Contact form error: ' . $e->getMessage());
        return response()->json([
            'message' => 'Failed to send message.'
        ], 500);
    }
}


}
