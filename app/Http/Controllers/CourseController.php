<?php

namespace App\Http\Controllers;

use App\models\course;
use App\models\subject;
use App\models\teacher;
use App\models\classroom;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('course.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Flashy::message('test flashy');
        flashy()->success('La séance de cours a bien été enregistré !', "ok");
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'register' => 'required | string | min:3 | alpha_dash',
            'classroom_code' => 'required | string | min:3 | alpha_dash',
            'subject_code' => 'required | string | min:3 | alpha_dash',
            'missing' => 'required | numeric | min:0',
            'date' => ' date | before:tomorrow',
        ]);

        course::create($data);
        Flashy::message('La séance de cours a bien été enregistré !');
        flashy()->success('La séance de cours a bien été enregistré !');

        session()->flash('registered', 'La séance de cours a bien été enregistrée !');

        return back();
    }

    public function destroy(course $course){
        
        $course->delete();

        return back()->with('registered', "Suppression réussie");
    }

    public function getCourse(Request $request){
        $courses = course::where("register", $request->register)->get()->values() ;
        foreach ($courses as $course) {
            $course->subject_code = subject::where("code", $course->subject_code)->first()->libel;
            $course->classroom_code = classroom::where("code", $course->classroom_code)->first()->libel;
            $course->register = teacher::where('register', $course->register)->first()->fullname;
        }

        return $courses->toArray();
    }
}
