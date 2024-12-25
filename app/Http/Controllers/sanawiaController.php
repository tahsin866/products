<?php

namespace App\Http\Controllers;
use App\Models\students_number_potrro;
use Illuminate\Http\Request;
use Inertia\Inertia;



class sanawiaController extends Controller
{

    public function sanawia(Request $request)
    {
        $query = students_number_potrro::where('CID', 3);

        if ($request->year) {
            $query->where('years', $request->year); // Apply year filter
        }

        $students_sawnawia = $query->paginate(15)->withQueryString();
        $years = students_number_potrro::select('years')->distinct()->pluck('years');

        return Inertia::render('marhala/sanawaia', [
            'students_sawnawia' => $students_sawnawia,
            'years' => $years,
            'filters' => [
                'year' => $request->year
            ]
        ]);
    }

}
