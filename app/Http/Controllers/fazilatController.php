<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\students_number_potrro;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;

class fazilatController extends Controller
{
    public function demo(Request $request)
    {
        // Cache distinct years for optimization
        $years = Cache::remember('distinct_years', 60, function () {
            return students_number_potrro::select('years')->distinct()->pluck('years');
        });

        $query = students_number_potrro::where('CID', 2);

        $totalCount = Cache::remember('total_count', 60, function () {
            return students_number_potrro::where('CID', 2)->count();
        });

        $yearCount = 0;
        $maleCount = 0;
        $femaleCount = 0;

        if ($request->year) {
            $query->where('years', $request->year);

            // Aggregate counts in a single query
            $counts = students_number_potrro::where('CID', 2)
                ->where('years', $request->year)
                ->selectRaw('COUNT(*) as total, SUM(CASE WHEN SRType = 1 THEN 1 ELSE 0 END) as male, SUM(CASE WHEN SRType = 0 THEN 1 ELSE 0 END) as female')
                ->first();

            $yearCount = $counts->total;
            $maleCount = $counts->male;
            $femaleCount = $counts->female;
        }

        if ($request->filled('Roll') && $request->filled('reg_id')) {
            $query->where('Roll', 'like', '%' . $request->Roll . '%')
                  ->where('reg_id', 'like', '%' . $request->reg_id . '%');
        }

        $students = $query->paginate(15)->withQueryString();

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

    public function details($Roll, $reg_id)
    {
        $details = students_number_potrro::where('CID', 2)
            ->where('Roll', $Roll)
            ->where('reg_id', $reg_id)
            ->firstOrFail();

        return inertia::render('marhala/fazilatDetailes', [
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

    public function cirtificateProvide()
    {
        $arabicYears = Cache::remember('arabic_years', 60, function () {
            return students_number_potrro::select('years')->distinct()->get();
        });

        $bengaliYears = Cache::remember('bengali_years', 60, function () {
            return student::select('years')->distinct()->get();
        });

        return Inertia::render('marhala/cirtificateProvide', [
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
        $bengaliYears = Cache::remember('bengali_years', 60, function () {
            return student::select('years')->distinct()->get();
        });

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

    public function generatePdf($Roll, $reg_id)
    {
        $details = students_number_potrro::where('CID', 2)
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
