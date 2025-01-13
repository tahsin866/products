<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\apllyAplication;
use App\Models\student;
use App\Models\students_number_potrro;
use Illuminate\Support\Facades\Cache;


class CertificateApplicationController extends Controller
{


    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'Certificate_Type' => 'required|string|max:255',
            'Class_name' => 'required|string|max:255',
            'student_bangla_name' => 'required|string|max:255',
            'student_arabic_name' => 'nullable|string|max:255',
            'student_english_name' => 'required|string|max:255',
            'student_Father_name_bn' => 'required|string|max:255',
            'student_Father_name_ar' => 'nullable|string|max:255',
            'student_Father_name_en' => 'required|string|max:255',
            'Roll' => 'required|integer',
            'reg_id' => 'required|integer',
            'MID' => 'required|string|max:255',
            'madrasha_name_en' => 'required|string|max:255',
            'madrasha_name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048', // 2MB max size
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
        }

        // Save data to the database
        apllyAplication::create($validatedData);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Application submitted successfully!');


    }


    // public function search(Request $request)
    // {
    //     // Get distinct years
    //     $years = Cache::remember('distinct_years', 60, function () {
    //         return students_number_potrro::select('years')->distinct()->pluck('years');
    //     });

    //     if ($request->has(['year', 'roll', 'reg_id'])) {
    //         $validated = $request->validate([
    //             'year' => 'required|exists:students_number_potrro,years',
    //             'roll' => 'required|numeric',
    //             'reg_id' => 'required|string'
    //         ]);

    //         $results = students_number_potrro::where([
    //             'years' => $validated['year'],
    //             'roll' => $validated['roll'],
    //             'reg_id' => $validated['reg_id']
    //         ])->get();

    //         return inertia::render('application', [
    //             'years' => $years,
    //             'results' => $results,
    //             'filters' => $validated
    //         ]);
    //     }


    // }






    // public function searchBn(Request $request)
    // {
    //     $arabicYears = Cache::remember('arabic_years', 60, function () {
    //         return students_number_potrro::select('years')->distinct()->get();
    //     });

    //     $bengaliYears = Cache::remember('bengali_years', 60, function () {
    //         return student::select('years')->distinct()->get();
    //     });

    //     if (!$request->filled(['year', 'Roll', 'reg_id'])) {
    //         return Inertia::render('applicationForm', [
    //             'arabicYears' => $arabicYears,
    //             'bengaliYears' => $bengaliYears,
    //             'bengaliStudentData' => []
    //         ]);
    //     }

    //     $bengaliStudentData = student::where([
    //         ['years', $request->year],
    //         ['Roll', $request->Roll],
    //         ['reg_id', $request->reg_id],
    //         ['CID', 2]
    //     ])->get();

    //     return Inertia::render('applicationForm', [
    //         'arabicYears' => $arabicYears,
    //         'bengaliYears' => $bengaliYears,
    //         'bengaliStudentData' => $bengaliStudentData
    //     ]);
    // }





    // public function details($Roll, $reg_id)
    // {
    //     $details = students_number_potrro::where('CID', 2)
    //         ->where('Roll', $Roll)
    //         ->where('reg_id', $reg_id)
    //         ->firstOrFail();

    //     return inertia::render('applicationForm', [
    //         'studentDetails' => $details,
    //     ]);
    // }







    }




























