<?php
namespace App\Filament\Resources\CustomLoginHandlerResource\Api\Handlers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\CustomLoginHandlerResource;

class LoginHandler extends Handlers {
    public static function handle(Request $request)
    {
        $credentials = $request->only('login', 'password', 'agence');

        // Determine login type based on input (email or name)
        $loginType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Validate login credentials
        if (!Auth::attempt([$loginType => $credentials['login'], 'password' => $credentials['password']])) {
            throw ValidationException::withMessages([
                'login' => __('auth.failed'),
            ]);
        }

        // Retrieve the authenticated user
        $user = Auth::user();

        // Generate API token using Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        // Return token as JSON response
        return response()->json(['token' => $token]);
    }
}
