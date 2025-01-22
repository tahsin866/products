<?php

namespace App\Http\Controllers;
use App\Models\students_number_potrro;
use App\Models\apllyAplication;
use Illuminate\Http\Request;
use Inertia\Inertia;
class englishApllyController extends Controller
{





    public function search(Request $request)
    {
        $years = students_number_potrro::select('years')
            ->distinct()
            ->orderBy('years', 'desc')
            ->pluck('years');

        if ($request->has(['years', 'Roll', 'reg_id'])) {
            $results = students_number_potrro::query()
                ->when($request->years, function ($query, $years) {
                    return $query->where('years', $years);
                })
                ->when($request->Roll, function ($query, $Roll) {
                    return $query->where('Roll', $Roll);
                })
                ->when($request->reg_id, function ($query, $reg_id) {
                    return $query->where('reg_id', $reg_id);
                })
                ->get();
        } else {
            $results = [];
        }

        return Inertia::render('applicationForm', [
            'availableYears' => $years,
            'searchResults' => $results
        ]);




    }





    public function details($Roll, $reg_id)
    {
        $details = students_number_potrro::where('Roll', $Roll)
            ->where('reg_id', $reg_id)
            ->firstOrFail();

        return inertia::render('applicationStuDetailes', [
            'studentDetails' => $details,
        ]);
    }






    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'Certificate_Type',
            'Class_name',
            'student_bangla_name' ,
            'student_arabic_name' ,
            'student_english_name' ,
            'student_Father_name_bn',
            'student_Father_name_ar',
            'student_Father_name_en',
            'Roll',
            'reg_id',
            'MID',
            'madrasha_name_en',
            'madrasha_name',
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




};
