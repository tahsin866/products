<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\students_number_potrro;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;




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
            'femaleCount' => $femaleCount,

        ]);



    }


// বিস্তারিত


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




    // সংশোধনী

    public function update(Request $request)
    {
        students_number_potrro::where('Roll', $request->Roll)
            ->where('reg_id', $request->reg_id)
            ->update($request->all());

        return back()->with('success', 'Student information updated successfully');
    }





//    search


// public function search(Request $request)
// {
//     $student = students_number_potrro::where('Roll', $request->Roll)
//         ->where('reg_id', $request->reg_id)
//         ->first();

//     return Inertia::render('marhala.search', [
//         'student' => $student
//     ]);
// }





// cirtificateProvide

public function cirtificateProvide()
{
    $arabicYears = students_number_potrro::select('years')->distinct()->get();
    $bengaliYears = student::select('years')->distinct()->get();

    return Inertia::render('marhala/cirtificateProvide', [
        'arabicYears' => $arabicYears,
        'bengaliYears' => $bengaliYears,
        'arabicStudentData' => [],
        'bengaliStudentData' => []
    ]);
}




public function search(Request $request)
{
    $arabicYears = students_number_potrro::select('years')->distinct()->get();

    if (!$request->filled(['year', 'Roll', 'reg_id'])) {
        return Inertia::render('marhala/cirtificateProvide', [
            'arabicYears' => $arabicYears,
            'arabicStudentData' => []
        ]);
    }

    $arabicStudentData = students_number_potrro::where([
        ['years', $request->year],
        ['Roll', $request->Roll],
        ['reg_id', $request->reg_id],
        ['CID', 2]
    ])->get();

    return Inertia::render('marhala/cirtificateProvide', [
        'arabicYears' => $arabicYears,
        'arabicStudentData' => $arabicStudentData
    ]);
}

public function searchBn(Request $request)
{
    $bengaliYears = student::select('years')->distinct()->get();

    if (!$request->filled(['year', 'Roll', 'reg_id'])) {
        return Inertia::render('marhala/cirtificateProvide', [
            'bengaliYears' => $bengaliYears,
            'bengaliStudentData' => []
        ]);
    }

    $bengaliStudentData = student::where([
        ['years', $request->year],
        ['Roll', $request->Roll],
        ['reg_id', $request->reg_id],
        ['CID', 2]
    ])->get();

    return Inertia::render('marhala/cirtificateProvide', [
        'bengaliYears' => $bengaliYears,
        'bengaliStudentData' => $bengaliStudentData
    ]);
}












// generatePdf


public function generatePdf($Roll, $reg_id)
{
    $details = students_number_potrro::where('CID', 2)
        ->where('Roll', $Roll)
        ->where('reg_id', $reg_id)
        ->first();

    if (!$details) {
        return response()->json(['message' => 'Student not found'], 404);
    }

    $pdf = PDF::loadView('pdfs.student-certificate', [
        'studentDetails' => $details,
    ]);

    $pdf->setPaper('A4');
    $pdf->set_option('isHtml5ParserEnabled', true);
    $pdf->set_option('isPhpEnabled', true);

    $fileName = "certificate_{$Roll}_{$reg_id}.pdf";

    return $pdf->download($fileName);
}









}


