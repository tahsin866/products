<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\students_number_potrro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use function Termwind\render;
use Inertia\Inertia;
use Rakibhstu\Banglanumber\NumberToBangla;









class fazilatController extends Controller
{





    public function demo(Request $request)
    {
        // Base query
        $query = students_number_potrro::where('CID', 2);

        // Total count (all years)
        $totalCount = students_number_potrro::where('CID', 2)->count();

        // Initialize counts
        $yearCount = 0;
        $maleCount = 0;
        $femaleCount = 0;

        // Get counts based on year selection
        if ($request->year) {
            // Get total count for selected year
            $yearCount = students_number_potrro::where('CID', 2)
                ->where('years', $request->year)
                ->count();

            // Get male count (SRType = 1)
            $maleCount = students_number_potrro::where('CID', 2)
                ->where('SRType', 1)
                ->where('years', $request->year)
                ->count();

            // Get female count (SRType = 0)
            $femaleCount = students_number_potrro::where('CID', 2)
                ->where('SRType', 0)
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
            'yearCount' => $yearCount,
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount
        ]);
    // 'students' => $query->paginate(10), // Example: Paginate the students


    }





    public function details($Roll, $reg_id) {
        $details = students_number_potrro::where('CID', 2)
            ->where('Roll', $Roll)
            ->where('reg_id', $reg_id)
            ->first();

        if (!$details) {
            return inertia::render('marhala/fazilatDetailes', [
                'error' => 'Student not found.',
            ]);
        }

        return inertia::render('marhala/fazilatDetailes', [
            'studentDetails' => $details,
        ]);
    }







}
