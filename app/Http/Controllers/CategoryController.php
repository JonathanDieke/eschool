<?php

namespace App\Http\Controllers;

use App\models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return category::all()->toArray();
    }

    public function create(){

        $models = null;
        $titleCard = "Enregistrer une nouvelle catégorie";
        $select = false;
        $dataform = collect([
            ['for' => 'code', 'label' => 'Code de la catégorie : ', 'type' => 'text'],
            ['for' => 'libel', 'label' => 'Libellé de la catégorie : ', 'type' => 'text'],
        ]);

        return view('parametrage.category', compact('models', 'titleCard', 'select', 'dataform'));
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
            'code' => 'required | string | min:3 | alpha_dash' ,
            'libel' => 'required | string | min:3' ,
        ]);

        $data['libel'] = Str::title($data['libel']);
        $data['code'] = Str::of($data['code'])->upper();

        category::updateOrCreate(['code' => $data['code'] ], $data);

        return 'store';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        if(! category::findOrFail( category::where('code', $request->code)->get()->first()->id ) )
            abort(404);

        $data = $request->validate([
            'code' => 'required | string | min:3 | alpha_dash' ,
            'libel' => 'required | string | min:3' ,
        ]);

        $data['libel'] = Str::title($data['libel']);
        $data['code'] = Str::upper($data['code']);

        $category->update($data);

        return 'update';
    }

    public function show(category $category)
    {
        foreach($category->subject as $subject ){
            $s[] = $subject->only(['id', 'libel']) ;
        }
        return $s;
    }

    public function getCategory($id)
    {
        return category::find($id)->subject;


    }

    public function drop($id)
    {
        category::destroy( explode(',', trim($id))) ;

        return 'Suppression réussie';
    }
}
