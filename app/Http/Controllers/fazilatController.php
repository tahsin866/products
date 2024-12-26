<?php

namespace App\Http\Controllers;

use App\Models\students_number_potrro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use function Termwind\render;
use Inertia\Inertia;


class fazilatController extends Controller
{



    // public function demo(Request $request)
    // {
    //     $query = students_number_potrro::where('CID', 2);

    //     if ($request->year) {
    //         $query->where('years', $request->year); // Apply year filter
    //     }

    //     // Paginate with current page and year filter
    //     $students = $query->paginate(15)->withQueryString(); // This will ensure pagination works and keeps query params

    //     $years = students_number_potrro::select('years')->distinct()->pluck('years');

    //     return Inertia::render('marhala/fazilat', [
    //         'students' => $students,
    //         'years' => $years,
    //         'filters' => [
    //             'year' => $request->year
    //         ]
    //     ]);
    // }



    // public function search(Request $request)
    // {
    //     $roll = $request->Roll;
    //     $reg_id = $request->reg_id; // Get the Roll number from the request

    //     // Find the student by Roll
    //     $student = students_number_potrro::where('Roll', $roll)->where('reg_id', $reg_id )->first();

    //     if ($student) {
    //         return Inertia::render('FazilatDetails', [
    //             'student' => $student  // Pass the student data to the Inertia view
    //         ]);
    //     }

    //     // If no student found, you can return a message or handle the error
    //     return Inertia::render('FazilatDetails', [
    //         'message' => 'Student not found'
    //     ]);
    // }




    // public function count(Request $request)
    // {
    //     $count = students_number_potrro::where('CID', 2)
    //         ->where('SRType', 1)
    //         ->count();

    //     return inertia::render('marhala/fazilat', [
    //         'studentCount' => $count
    //     ]);
    // }




    public function demo(Request $request)
    {
        // Base query
        $query = students_number_potrro::where('CID', 2);

        // Total count (all years)
        $totalCount = students_number_potrro::where('CID', 2)

            ->count();

        // Year-specific count
        $yearCount = 0;
        if ($request->year) {
            $yearCount = students_number_potrro::where('CID', 2)
                ->where('SRType', 1)
                ->where('years', $request->year)
                ->count();
            $query->where('years', $request->year);
        }

        // Search functionality
        if ($request->filled('Roll') && $request->filled('reg_id')) {
            $query->where('Roll', 'like', '%' . $request->Roll . '%')
                  ->where('reg_id', 'like', '%' . $request->reg_id . '%');
        }

        // Get paginated results
        $students = $query->paginate(15)->withQueryString();
        $years = students_number_potrro::select('years')->distinct()->pluck('years');

        return Inertia::render('marhala/fazilat', [
            'students' => $students,
            'years' => $years,
            'filters' => [
                'year' => $request->year
            ],
            'studentCount' => $totalCount,
            'yearCount' => $yearCount
        ]);
    }












}
