<?php

namespace App\Http\Controllers;

use App\Compte_divisionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompteDivController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=DB::table('compte_divisionnaires')->
        join('comptes','comptes.numero_compte','=','compte_divisionnaires.compte')->
        select('comptes.numero_compte as NumCompte','comptes.libelle as LibelleCompte',
            'compte_divisionnaires.numero_compte_div as NumCompteDiv',
             'compte_divisionnaires.libelle as LibCompteDiv',
             'compte_divisionnaires.libelle as DescCompteDiv')->get();
        //$list=Compte_divisionnaire::all();
        return response()->json($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if ($request){
           if(isset($request->numero) && isset($request->libelle) && isset($request->compte)){
               $compteDiv=new Compte_divisionnaire();
               $compteDiv->numero_compte_div=$request->numero;
               $compteDiv->libelle=$request->libelle;
               if(DB::table('compte_divisionnaires')->where('numero_compte_div',$compteDiv->numero_compte_div)->orWhere("libelle",$compteDiv->libelle)->first()!==null){
                   $compteDiv=DB::table('compte_divisionnaires')->where('numero_compte_div',$compteDiv->numero_compte_div)->orWhere("libelle",$compteDiv->libelle)->first();
                   return response()->json([
                       'message'=>'Ce compte divisionnaire existe déjà',
                       'objet'=>$compteDiv
                   ]);
               }else{
                    if(DB::table('comptes')->whereNumero_compte($request->compte)->first()===null){
                        return response()->json(['message'=>'Le compte fournit est inexistant']);
                    }else{
                        $compteDiv->compte=$request->compte;
                        if(strlen($compteDiv->numero_compte_div)!=3){
                            return response()->json([
                                'message'=>'Le numéro du compte divisionnaire ne doit avoir que deux caractères,pas plus pas moins'
                            ]);
                        }else {
                            if(substr($compteDiv->numero_compte_div,0,2)==$compteDiv->compte){
                                DB::table('compte_divisionnaires')->insert([
                                    'numero_compte_div' => $compteDiv->numero_compte_div,
                                    'libelle' => $compteDiv->libelle,
                                    'compte' => $compteDiv->compte
                                ]);
                                return response()->json([
                                    'message' => 'Le compte divisionnaire a été ajouté',
                                    'object' => $compteDiv
                                ]);
                            }else{
                                return response()->json([
                                   'message'=>'Les deux premiers caractères du numero sont différents du numerp de compte'
                                ]);
                            }

                        }
                    }
               }
           }else{
               return response()->json([
                  'message'=>'Au moins une information est manquante'
               ]);
           }
       }else{
           return response()->json([
              'message'=>'Veuillez fournir les paramètres'
           ]);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compte_divisionnaire  $compte_divisionnaire
     * @return \Illuminate\Http\Response
     */
    public function show($numero)
    {
        $compte_div=DB::table('compte_divisionnaires')->where('numero_compte_div',$numero)->first();
        return response()->json($compte_div);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compte_divisionnaire  $compte_divisionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compte_divisionnaire $compte_divisionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compte_divisionnaire  $compte_divisionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compte_divisionnaire $compte_divisionnaire)
    {
        //
    }
}
