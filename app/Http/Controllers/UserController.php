<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function generate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Generate PDF using DomPDF
        $pdf = PDF::loadView('pdf', ['record' => $user]);

        // Return PDF as download
        // Return PDF for printing
        return $pdf->stream($user->name . '.pdf');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'password' => 'required'
            ]);

            $credentials = request(['name', 'password']);
            if (!Auth::attempt($credentials)) {
                return $this->sendError('Unauthorized', 'Authentication Failed', 500);
            }

            //Jika hash tidak sesuai
            $user = User::where('name', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            //jika berhasil maka login
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return $this->sendResponse([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');
        } catch (Exception $error) {
            return $this->sendError(
                [
                    'message' => 'Something went wrong',
                    'error' => $error
                ],
                'Login Failed',
            );
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
                'password' => ['required', 'min:6']
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user = User::where('email', $request->email)->first();
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            $data = [
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ];
            return $this->sendResponse($data, 'Successfull Register');
        } catch (Exception $error) {
            return $this->sendError(
                [
                    'message' => 'Something went wrong',
                    'error' => $error
                ],
                'Registration Failed',
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {

            $user = Auth::user($user);

            return $this->sendResponse($user, 'Successfull get user');
        } catch (Exception $error) {
            return $this->sendError(
                [
                    'message' => 'Something went wrong',
                    'error' => $error
                ],
                'Authentication Failed',
            );
        }
    }


    public function logout(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->tokens()->delete();
        return response()->noContent();
    }


}
