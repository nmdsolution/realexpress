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
}
