<?php

namespace App\Http\Controllers;
use App\Models\students_number_potrro;
use Illuminate\Http\Request;
use Inertia\Inertia;
class findtStudentController extends Controller
{




    // public function search(Request $request)
    // {
    //     $years = students_number_potrro::select('years')
    //         ->distinct()
    //         ->orderBy('years', 'desc')
    //         ->pluck('years');

    //     if ($request->has(['years', 'Roll', 'reg_id'])) {
    //         $results = students_number_potrro::query()
    //             ->when($request->years, function ($query, $years) {
    //                 return $query->where('years', $years);
    //             })
    //             ->when($request->Roll, function ($query, $Roll) {
    //                 return $query->where('Roll', $Roll);
    //             })
    //             ->when($request->reg_id, function ($query, $reg_id) {
    //                 return $query->where('reg_id', $reg_id);
    //             })
    //             ->get();
    //     } else {
    //         $results = [];
    //     }

    //     return Inertia::render('applicationForm', [
    //         'availableYears' => $years,
    //         'searchResults' => $results
    //     ]);




    // }




    public function search()
    {
        return Inertia::render('find_result/studentResultFind', [
            'availableYears' => students_number_potrro::select('years')
                ->distinct()
                ->orderBy('years', 'desc')
                ->pluck('years'),
            'searchResults' => []
        ]);
    }















}
