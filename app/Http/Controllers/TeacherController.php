<?php

namespace App\Http\Controllers;

use App\models\teacher;
use \App\models\category;
use \App\models\subject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers  = teacher::all()->each(function($t){
            $t->category_id = $t->subject->category->libel;
            $t->subject_id = $t->subject->libel;
        });

        return $teachers->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\return response()->download($pathToFile, $name, $headers);
     */
    public function create()
    {
        $categories = category::all();
        $subjects = subject::all();
        $models = null;
        $titleCard = "Enregistrer une nouvelle catégorie";
        $action = "category.store";
        $select = false;
        $dataform = collect([
            ['for'=> 'code', 'label'=> 'Code de la catégorie : ', 'type' => 'text'],
            ['for'=> 'libel', 'label'=> 'Libellé de la catégorie : ', 'type' => 'text'],
        ]);

        return view('parametrage.teacher-category', compact('categories', 'subjects', 'models', 'titleCard', 'action', 'select', 'dataform'));
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
            'register' => 'required | string | min:3 | alpha_dash' ,
            'category_id' => 'required | integer | min:1' ,
            'subject_id' => 'required | integer | min:1' ,
            'fullname' => 'required | string | min:3' ,
            'email' => 'required | string | min:3 | email' ,
            'birthday' => 'required | date | before:2000-01-01 | after:1960-01-01' ,
            'birthplace' => 'required | string | min:3' ,
            'avatar' => 'required | file | image | max:1024' ,
        ]);

        $data['register'] = Str::of($data['register'])->upper();
        $data['fullname'] = Str::title($data['fullname']);
        $data['avatar'] = request('avatar')->store('avatars', 'public');

        teacher::updateOrCreate( [ "register" => $data["register"] ], $data);

        return 'store';
    }

    public function show(teacher $teacher){
        $data = [
            "Nom et Prénom : " => $teacher->fullname,
            "Matricule : " => $teacher->register,
            "Catégorie : " => $teacher->subject->category->libel,
            "Matière : " => $teacher->subject->libel,
            "Date de Naissance : " => $teacher->birthday,
            "Lieu de Naissance : " => $teacher->birthplace,
            "avatar" => $teacher->avatar,
        ];

        $data = collect($data);

        return view("parametrage.teacher-show", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, teacher $teacher)
    {
        if(! teacher::findOrFail( teacher::where('register', $request->register)->get()->first()->id ) )
            abort(404);

        $data = $request->validate([
            'register' => 'required | string | min:3 | alpha_dash' ,
            'category_id' => 'required | integer | min:1' ,
            'subject_id' => 'required | integer | min:1' ,
            'fullname' => 'required | string | min:3' ,
            'email' => 'required | string | min:3 | email' ,
            'birthday' => 'required | date | before:2000-01-01 | after:1960-01-01' ,
            'birthplace' => 'required | string | min:3' ,
            'avatar' => 'required | file | size:1024' ,
        ]);

        $data['register'] = Str::upper($data['register']);
        $data['fullname'] = Str::title($data['fullname']);
        $data['avatar'] = request('avatar')->store('avatars', 'public');

        teacher::updateOrCreate( [ "register" => $data["register"] ], $data);

        return 'update';
    }

    public function getTeacher($register)
    {
        $t = teacher::where('register', 'LIKE', "%$register%")->get();

        return $t;
    }

    public function drop($id)
    {
        teacher::destroy( explode(',', trim($id)) );

        return 'Suppresion réussie';
    }

}
