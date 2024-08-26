<?php

namespace App\Http\Controllers;

use App\Models\Expedition;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpeditionController extends Controller
{
    public function generate(Request $request, $id)
    {
        $expedition = Expedition::findOrFail($id);
        // Get the base64 encoded image data
        $imageData = base64_encode(file_get_contents(public_path('/images/logo.png')));
        $imageSrc = 'data:images/png;base64,' . $imageData;

        // Generate PDF using DomPDF
        $pdf = PDF::loadView('pdf', ['record' => $expedition, 'imageSrc' => $imageSrc]);


        // Return PDF as download
        // Return PDF for printing
        return $pdf->stream($expedition->name . '.pdf');
    }

}
