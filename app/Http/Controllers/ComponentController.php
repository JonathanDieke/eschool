<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\component;

class ComponentController extends Controller
{
    public function index(){
        $components = component::all()->toJson();
        return view('testComponent', compact('components'));
    }

    public function store(){
        return component::create([
            'pseudo' => request('pseudo'),
            'text' => request('text'),
        ]);
    }
}
