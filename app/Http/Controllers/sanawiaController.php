<?php

namespace App\Http\Controllers;
use App\Models\students_number_potrro;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\student;

use App\Models\Division;
use App\Models\District;
use App\Models\thana;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;


class sanawiaController extends Controller
{

    public function sanawia(Request $request)
    {
        // Cache distinct years for optimization
        $years = Cache::remember('distinct_years', 60, function () {
            return students_number_potrro::select('years')->distinct()->pluck('years');
        });


        $division = Cache::remember('distinct_years', 60, function () {
            return students_number_potrro::with('madrasha')->select('division')->distinct()->pluck('division');
        });


        $SRType = Cache::remember('distinct_SRType', 60, function () {
            return students_number_potrro::select('SRType')->distinct()->pluck('SRType');
        });

        $totalCount = Cache::remember('total_count', 60, function () {
            return students_number_potrro::where('CID', 3)->count();
        });



        $query = students_number_potrro::where('CID', 3);

        // Initialize counts
        $yearCount = 0;
        $maleCount = 0;
        $femaleCount = 0;

        // Base query for counts
        $countsQuery = students_number_potrro::where('CID', 3);

        // Apply year filter if selected
        if ($request->year) {
            $query->where('years', $request->year);
            $countsQuery->where('years', $request->year);
        }

        // Apply SRType filter if selected
        if ($request->SRType !== null) {
            $query->where('SRType', $request->SRType);
            $countsQuery->where('SRType', $request->SRType);
        }

        // Get counts in a single query
        $counts = $countsQuery->selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN SRType = 1 THEN 1 ELSE 0 END) as male,
            SUM(CASE WHEN SRType = 0 THEN 1 ELSE 0 END) as female
        ')->first();

        $yearCount = $counts->total;
        $maleCount = $counts->male;
        $femaleCount = $counts->female;

        $students = $query->with('madrasha')->paginate(15)->withQueryString();

        return Inertia::render('sanawia/sanawaia', [
            'students' => $students,
            'SRType' => $SRType,
            'years' => $years,
            'division'=>$division,
            'filters' => [
                'year' => $request->year,
                'SRType' => $request->SRType,
                'division'=>$request ->division
            ],
            'studentCount' => $totalCount,
            'yearCount' => $yearCount,
            'maleCount' => $maleCount,
            'femaleCount' => $femaleCount,

        ]);



    }



    public function searchElhaq(Request $request)
    {
        $request->validate([
            'Elhaq' => 'nullable|string|max:255',
            'year' => 'nullable|string'
        ]);

        $query = students_number_potrro::query()->where('CID', 3);

        // Apply year filter if selected
        if ($request->filled('year')) {
            $query->where('years', $request->year);
        }

        // Apply Elhaq filter
        if ($request->filled('Elhaq')) {
            $query->where('Elhaq', $request->Elhaq);
        }

        // Clone query before pagination for counts
        $countQuery = clone $query;

        // Get paginated results with relationships
        $searchResults = $query->with('madrasha')->paginate(15);

        // Calculate counts using the cloned query
        $counts = $countQuery->selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN SRType = 1 THEN 1 ELSE 0 END) as male,
            SUM(CASE WHEN SRType = 0 THEN 1 ELSE 0 END) as female
        ')->first();

        return Inertia::render('sanawia/sanawaia', [
            'students' => $searchResults,
            'yearCount' => $counts->total ?? 0,
            'maleCount' => $counts->male ?? 0,
            'femaleCount' => $counts->female ?? 0,
            'filters' => [
                'Elhaq' => $request->Elhaq,
                'year' => $request->year
            ]
        ]);
    }




 // LocationController.php
// public function index()
// {
//     return Inertia::render('marhala/divisions', [
//         'divisions' => Division::select('ID', 'Division')->get(),
//         'districts' => district::select('DesID', 'district', 'DID')->get(),
//         'thanas' => thana::select('ID', 'thana', 'Des_ID')->get()
//     ]);
// }
















    public function details($Roll, $reg_id)
    {
        $details = students_number_potrro::where('CID', 3)
            ->where('Roll', $Roll)
            ->where('reg_id', $reg_id)
            ->firstOrFail();

        return inertia::render('sanawia/sanawaiaDetailes', [
            'studentDetails' => $details,
        ]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'Roll' => 'required',
            'reg_id' => 'required',
        ]);

        students_number_potrro::where('Roll', $request->Roll)
            ->where('reg_id', $request->reg_id)
            ->update($request->except(['_token']));

        return back()->with('success', 'Student information updated successfully');
    }



    public function sanawiacirtificateProvide()
    {
        $arabicYears = Cache::remember('arabic_years', 60, function () {
            return students_number_potrro::select('years')->distinct()->get();
        });

        $bengaliYears = Cache::remember('bengali_years', 60, function () {
            return student::select('years')->distinct()->get();
        });

        return Inertia::render('sanawia/sanawiacirtificateProvide', [
            'arabicYears' => $arabicYears,
            'bengaliYears' => $bengaliYears,
            'arabicStudentData' => [],
            'bengaliStudentData' => []
        ]);
    }

    public function search(Request $request)
    {
        $arabicYears = Cache::remember('arabic_years', 60, function () {
            return students_number_potrro::select('years')->distinct()->get();
        });

        $bengaliYears = Cache::remember('bengali_years', 60, function () {
            return student::select('years')->distinct()->get();
        });

        if (!$request->filled(['year', 'Roll', 'reg_id'])) {
            return Inertia::render('sanawia/sanawiacirtificateProvide', [
                'arabicYears' => $arabicYears,
                'bengaliYears' => $bengaliYears,
                'arabicStudentData' => []
            ]);
        }

        $arabicStudentData = students_number_potrro::where([
            ['years', $request->year],
            ['Roll', $request->Roll],
            ['reg_id', $request->reg_id],
            ['CID', 2]
        ])->get();

        return Inertia::render('sanawia/sanawiacirtificateProvide', [
            'arabicYears' => $arabicYears,
            'bengaliYears' => $bengaliYears,
            'arabicStudentData' => $arabicStudentData
        ]);
    }

    public function searchBn(Request $request)
    {
        $arabicYears = Cache::remember('arabic_years', 60, function () {
            return students_number_potrro::select('years')->distinct()->get();
        });

        $bengaliYears = Cache::remember('bengali_years', 60, function () {
            return student::select('years')->distinct()->get();
        });

        if (!$request->filled(['year', 'Roll', 'reg_id'])) {
            return Inertia::render('sanawaia/sanawiacirtificateProvide', [
                'arabicYears' => $arabicYears,
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

        return Inertia::render('sanawaia/sanawiacirtificateProvide', [
            'arabicYears' => $arabicYears,
            'bengaliYears' => $bengaliYears,
            'bengaliStudentData' => $bengaliStudentData
        ]);
    }






    public function generatePdf($Roll, $reg_id)
    {



        $details = students_number_potrro::where('CID', 3)
            ->where('Roll', $Roll)
            ->where('reg_id', $reg_id)
            ->firstOrFail();

        $pdf = PDF::loadView('pdfs.student-certificate', [
            'studentDetails' => $details,
        ])
            ->setPaper('A4')
            ->set_option('isHtml5ParserEnabled', true)
            ->set_option('isPhpEnabled', true);

        $fileName = "certificate_{$Roll}_{$reg_id}.pdf";

        return $pdf->download($fileName);
    }

}
