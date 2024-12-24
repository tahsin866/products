<?php

namespace App\Http\Controllers;

use App\Models\students_number_potrro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use function Termwind\render;
use Inertia\Inertia;


class porductController extends Controller
{



    public function demo(Request $request)
    {
        // Fetch the first 2 student records for the year 2024
        $students = students_number_potrro::where('years', 2024)
        ->where('CID', 3)

            ->take(20)  // Limits the query to 2 records
            ->get();

        // Return the data to an Inertia page
        return Inertia::render('marhala/products', [
            'students' => $students,  // Pass students to the Vue component
        ]);
    }




}
