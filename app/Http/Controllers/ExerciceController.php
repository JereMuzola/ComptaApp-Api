<?php

namespace App\Http\Controllers;

use App\Exercice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExerciceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercices=Exercice::all();
        return $exercices->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array();
        $exercice=new Exercice();
        if (isset($request)) {
            if (isset($request->num_exercice) && isset($request->libelle) && isset($request->annee) && isset($request->commentaire)) {
                /*DB::table('exercices')->insert($request->validate([
                    'num_exercice' => 'required|max:2,2',
                    'libelle' => 'required',
                    'annee'=>'required',
                    'commentaire' => 'max:5,250',
                ]));*/
               $exercice->num_exercice=$request->num_exercice;
               $exercice->libelle=$request->libelle;
               $exercice->annee=$request->annee;
               $exercice->commentaire=$request->commentaire;
               if (DB::table('exercices')->whereNum_exercice($request->num_exercice)->first()!==null) {
                   $data['message']="Cet exercice existe déjà";
                   $exercice=DB::table('exercices')->whereNum_exercice($request->num_exercice)->first();
               } else{
                DB::table('exercices')->insert(['num_exercice'=>$exercice->num_exercice,'libelle'=>$exercice->libelle,'annee'=>$exercice->annee,'commentaire'=>$exercice->commentaire]);
                $data['message']="Exercice enregistré";
                //$data['objet']=$exercice->toJson();
                }
            }else{
                $data['message']="Au moins une information est manquante";
            }
        }else{
            $data['message']="Veuillez fournir les informations";
            // return response()->json(["message"=>""],201);
        }
        return response()->json([
            'message'=>$data,
            'objet'=>$exercice
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exercice=DB::table('exercices')->whereNum_exercice($id)->first();
        return response()->json($exercice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercice $exercice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exercice  $exercice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercice $exercice)
    {
        //
    }
}
