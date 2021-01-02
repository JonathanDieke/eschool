<?php

namespace App\Http\Controllers;

use App\models\room;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return room::all()->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $models = collect([]);
        $titlecard = "Enregistrer une nouvelle salle";
        $select = false;
        $dataform = collect([
            ['for'=> 'code', 'label'=> 'Code de la salle : ', 'type' => 'text'],
            ['for'=> 'libel', 'label'=> 'Libellé de la salle : ', 'type' => 'text'],
            ['for'=> 'capacity', 'label'=> 'Capacité de la salle : ', 'type' => 'number'],
        ]);
        return view("parametrage.room", compact('models', 'titlecard', 'select', 'dataform'));
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
            'code' => 'required  | string | alpha_dash ' ,
            'libel' => 'required | string | min:3' ,
            'capacity' => 'required | integer | min:24 | max:35' ,
        ]);

        $data['libel'] = Str::title($data['libel']);
        $data['code'] = Str::of($data['code'])->upper();

        room::updateOrCreate( [ "code" => $data["code"] ], $data);

        return 'store';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, room $room)
    {
        if(! room::findOrFail( room::where('code', $request->code)->get()->first()->id ) )
            abort(404);

        $data = $request->validate([
            'code' => 'required  | string | alpha_dash' ,
            'libel' => 'required | string | min:3' ,
            'capacity' => 'required | integer | min:24 | max:35' ,
        ]);

        $data['libel'] = Str::title($data['libel']);
        $data['code'] = Str::upper($data['code']);

        $room->update($data);

        return 'update';
    }

    public function drop($id)
    {
        room::destroy( explode("," , trim($id) ) );

        return 'Suppression réussie';
    }

    // Select student by register field to return to view for autocompletion
    public function getRoom($code){
        $r = room::where('code', 'LIKE', "%$code%")->get();
        return $r;
    }
}
