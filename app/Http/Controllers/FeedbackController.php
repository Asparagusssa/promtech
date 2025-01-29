<?php

namespace App\Http\Controllers;

use App\Mail\Feedback;
use App\Models\EmailType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'comment' => 'sometimes',
            'email-type' => 'required|exists:email_types,id',
        ]);

        $type = EmailType::findOrFail($validatedData['email-type']);

        $emailAddresses = $type->emails->pluck('email')->toArray();

        Mail::to($emailAddresses)->send(new Feedback(['name' => $validatedData['name'], 'email' => $validatedData['email'], 'comment' => $validatedData['comment']]));

        return response()->json('OK', 200);
    }
}
