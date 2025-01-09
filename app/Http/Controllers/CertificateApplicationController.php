<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\apllyAplication;
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
}

