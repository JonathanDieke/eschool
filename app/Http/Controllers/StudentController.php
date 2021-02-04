<?php

namespace App\Http\Controllers;

use App\models\student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\Cache;

class StudentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $models = Cache::remember('allClassrooms', now()->addMinutes(60), function(){
            return \App\models\classroom::all();
        });

        $titlecard = Cache::remember('titlecard-student', now()->addMinutes(60), function(){
            return "Inscrire un élève";
        });

        $select = Cache::remember('select-student', now()->addMinutes(60), function(){
            return true;
        });

        $dataform = Cache::remember('dataform-student', now()->addMinutes(60), function(){
            return collect([
                ['for' => 'classroom_id', 'label' => 'Classe : ',],
                ['for' => 'register', 'label' => 'Matricule : ', 'type' => 'text'],
                ['for' => 'fullname', 'label' => 'Nom et prenom : ', 'type' => 'text'],
                ['for' => 'birthday', 'label' => 'Date de naissance : ', 'type' => 'date'],
                ['for' => 'birthplace', 'label' => 'Lieu de naissance : ', 'type' => 'text'],
            ]);
        });

        return view('student.create', compact('models','titlecard','select','dataform'));

        // return compact('models','titlecard','select','dataform');
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
            'classroom_id' => 'required | integer | min:1' ,
            'register' => 'required | string | min:3 | alpha_dash' ,
            'fullname' => 'required | string | min:3' ,
            'birthday' => 'required | date | before:2017-01-01 | after:1950-01-01' ,
            'birthplace' => 'required | string | min:3' ,
            'avatar' => 'required | file | image | max:1024' ,
        ]);

        $data['register'] = Str::upper($data['register']);
        $data['fullname'] = Str::title($data['fullname']);
        $data['birthplace'] = Str::title($data['birthplace']);

        $data['avatar'] = request('avatar')->store('avatars',  ['disk' => 'public_folder']);


        student::updateOrCreate( [ "register" => $data["register"] ], $data);

        session()->flash("registered", "L'élève a bien été enregistré");

        return back();
    }

    public function show(student $student){

        $data = [
            "Nom et Prénom : " => $student->fullname,
            "Matricule : " => $student->register,
            "Classe : " => $student->classroom->libel,
            "Date de Naissance : " => $student->birthday,
            "Lieu de Naissance : " => $student->birthplace,
            "avatar" => $student->avatar,
        ];

        $data = collect($data);

        return view("student.show", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {

        if(!student::findOrFail( student::where('register', $request->register)->get()->first()->id ) )
            abort(404, "Ce matricule ne correspond à aucun élève !");

        $data = $request->validate([
        'classroom_id' => 'required | integer | min:1' ,
        'register' => 'required | string | min:3 | alpha_dash' ,
        'fullname' => 'required | string | min:3' ,
        'birthday' => 'required | date | before:2017-01-01 | after:1950-01-01' ,
        'birthplace' => 'required | string | min:3' , 
        ]);

        $data['fullname'] = Str::title($data['fullname']);
        $data['register'] = Str::upper($data['register']); 

        $student->update($data);

        session()->flash("registered", "L'élève a bien été enregistré");

        return 'update';
    }

    // Select student by register field to return to view for autocompletion
    public function getStudent($register){
        $s = student::where('register', 'LIKE', "%$register%")->get();
        return $s;
    }

    // Select all students of the same classroom for show in table of view
    public function showStudents($classroom_id){

        return student::where('classroom_id', $classroom_id)
                    ->get()
                    ->each(function($s){
                        $s->classroom_id = $s->classroom->libel;
                    })
                    ->toArray();
    }

    // Delete student(s) by get id
    public function drop($id)
    {
        student::destroy( explode("," , trim($id) ) );

        return 'Suppression réussie';
    }

}
