<?php

namespace App\Http\Controllers;

use App\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes=Classe::all();
        return response()->json($classes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=array();
        $classe=new Classe();
        if (isset($request)) {
            if (isset($request->code) && isset($request->libelle) && isset($request->description)) {
                    $classe->code=$request->code;
                    $classe->libelle=$request->libelle;
                    $classe->description=$request->description;
                    if (DB::table('classes')->whereCode($request->code)->first()!==null) {
                        $data['message']="Classe déjà existante";
                        $classe=DB::table('classes')->whereCode($request->code)->first();
                    }else{
                        $data['message']="Classe ajoutée";
                        DB::table('classes')->insert(['code'=>$classe->code,'libelle'=>$classe->libelle,'description'=>$classe->description]);
                    }
            }else{
                $data['message']="Au moins une information est manquante";
            }
        }else{
            $data['message']="Veuillez Fournir les informations";
        }
        return response()->json(['message'=>$data,'object'=>$classe]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $classe=DB::table('classes')->whereCode($code)->first();
        return response()->json($classe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classe  $classe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classe $classe)
    {
        //
    }
}
