<?php

namespace App\Http\Controllers;

use App\models\rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rating.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required | numeric ',
            'subject_code' => 'required | string | min:3 | alpha_num',
        ]);

        for ($i=0; $i < count($request->student); $i++) {
            $rating = \App\models\student::find($request->student[$i])
                        ->ratings()
                        ->where('subject_code', $request->subject_code)
                        ->where("teacher_id", $request->teacher_id)
                        ->first();

            if(empty($rating)){
                $rating = new \App\models\rating();
                $rating->student_id = $request->student[$i];
                $rating->subject_code = $request->subject_code;
                $rating->teacher_id = $request->teacher_id;
            }


            $rating->qz1 = $request->qz1[$i];
            $rating->qz2 = $request->qz2[$i];
            $rating->qz3 = $request->qz3[$i];
            $rating->assignment = $request->assignment[$i];
            $rating->examen = $request->examen[$i];

            // dd($rating);
            $rating->save();
        }

        session()->flash("registered", "Les notes ont bien été enregistrées");
        return view('rating.index');
    }

}
