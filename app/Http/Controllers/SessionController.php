<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\SessionService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    private SessionService $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            $response = $this->sessionService->login($request);
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function logout(Request $request)
    {
        $this->sessionService->logout($request);
        return response()->json(null,204);
    }
}
