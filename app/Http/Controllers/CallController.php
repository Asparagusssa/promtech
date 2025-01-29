<?php

namespace App\Http\Controllers;

use App\Mail\Call;
use App\Mail\Feedback;
use App\Models\EmailType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CallController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|max:50',
            'email-type' => 'required|exists:email_types,id',
        ]);

        $type = EmailType::findOrFail($validatedData['email-type']);

        $emailAddresses = $type->emails->pluck('email')->toArray();

        Mail::to($emailAddresses)->send(new Call(['name' => $validatedData['name'], 'phone' => $validatedData['phone']]));

        return response()->json('OK', 200);
    }
}
