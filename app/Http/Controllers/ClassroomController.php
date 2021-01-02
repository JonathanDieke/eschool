<?php

namespace App\Http\Controllers;

use App\models\classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = classroom::all()->each(function($cr){
            $cr->room_id = $cr->room->libel;
        });

        return $classrooms->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $models = \App\models\room::all();
        $titlecard = "Enregistrer une nouvelle classe";
        $select = true;
        $dataform = collect([
                ['for'=> 'room_id', 'label'=> 'Salle : ', ],
                ['for'=> 'code', 'label'=> 'Code de la classe : ', 'type' => 'text'],
                ['for'=> 'libel', 'label'=> 'Libellé de la classe : ', 'type' => 'text'],
        ]);

        return view("parametrage.classroom", compact('models', 'titlecard','select', 'dataform'));
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
            'room_id' => 'required | integer | min:1' ,
            'code' => 'required | string | min:3 | alpha_dash' ,
            'libel' => 'required | string | min:3' ,
        ]);

        $data['code'] = Str::of($data['code'])->upper();
        $data['libel'] = Str::of($data['libel'])->upper();

        classroom::updateOrCreate( [ "code" => $data["code"] ], $data);

        session ()->flash('registerd',"La classe a bien été enregistré");

        return 'store';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, classroom $classroom)
    {
        if(! classroom::findOrFail( classroom::where('code', $request->code)->get()->first()->id ) )
            abort(404);

        $data = $request->validate([
            'room_id' => 'required | integer | min:1' ,
            'code' => 'required | string | min:3 | alpha_dash' ,
            'libel' => 'required | string | min:3' ,
        ]);

        // $data = $request->validate([
        //     'room_id' => 'required | string | min:1' ,
        //     'code' => 'required | string | min:3 | alpha_dash' ,
        //     'libel' => 'required | string | min:3' ,
        // ]);

        $data['code'] = Str::upper($data['code']);
        $data['libel'] = Str::upper($data['libel']);

        $classroom->update($data);
        session()->flash('registerd', "La classe a bien été enregistré");

        return 'update';
    }

    public function getClassroom($code)
    {
        $cr = classroom::where('code', 'LIKE', "%$code%")->get();
        return $cr;
    }

    public function drop($id)
    {
        classroom::destroy( explode("," , trim($id) ) );

        return 'Suppression réussie';
    }
}
