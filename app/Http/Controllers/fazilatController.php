<?php

namespace App\Http\Controllers;

use App\Models\students_number_potrro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use function Termwind\render;
use Inertia\Inertia;


class fazilatController extends Controller
{



    public function demo(Request $request)
    {
        $query = students_number_potrro::where('CID', 2);

        if ($request->year) {
            $query->where('years', $request->year); // Apply year filter
        }

        // Paginate with current page and year filter
        $students = $query->paginate(15)->withQueryString(); // This will ensure pagination works and keeps query params

        $years = students_number_potrro::select('years')->distinct()->pluck('years');

        return Inertia::render('marhala/fazilat', [
            'students' => $students,
            'years' => $years,
            'filters' => [
                'year' => $request->year
            ]
        ]);
    }



    // public function search(Request $request)
    // {
    //     // Validate the incoming request for expected parameters
    //     $request->validate([
    //         'Roll' => 'required|string',
    //         'red_id' => 'required|string',
    //     ]);

    //     // Perform the query with the provided input
    //     $setudentSearch = students_number_potrro::where('Roll', $request->Roll)
    //         ->where('red_id', $request->red_id)
    //         ->get();

    //     // Return the data to the Inertia view
    //     return inertia::render('marhala/fazilat', [
    //         'setudentSearch' => $setudentSearch,
    //     ]);
    // }


    public function search(Request $request)
    {
        $roll = $request->Roll;  // Get the Roll number from the request

        // Find the student by Roll
        $student = students_number_potrro::where('Roll', $roll)->first();

        if ($student) {
            return Inertia::render('FazilatDetails', [
                'student' => $student  // Pass the student data to the Inertia view
            ]);
        }

        // If no student found, you can return a message or handle the error
        return Inertia::render('FazilatDetails', [
            'message' => 'Student not found'
        ]);
    }



}
