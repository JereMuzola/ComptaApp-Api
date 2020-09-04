<?php

namespace App\Http\Controllers;

use App\Sous_compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SousCompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$sous_comptes=Sous_compte::all();
        $liste=DB::table("sous_comptes")->join("compte_divisionnaires","compte_divisionnaires.numero_compte_div","=","sous_comptes.compte_divisionaire")
        ->select("sous_comptes.numero as numero","sous_comptes.libelle as libelle",
            "sous_comptes.description as description","compte_divisionnaires.numero_compte_div as NumCompteDiv",
            "compte_divisionnaires.libelle as LibCompteDiv")->orderBy("sous_comptes.numero")->get();


        return response()->json($liste);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sous_compte=new Sous_compte();
        if(isset($request)){
            if(isset($request->numero) && isset($request->libelle) && isset($request->compteDiv)){
                if(strlen($request->numero)!=5){
                    return response()->json([
                        'message'=>'Seulement 5 caractères pour le numéro, pas plus pas moins'
                    ]);
                }else{
                    if(DB::table('compte_divisionnaires')->whereNumero_compte_div($request->compteDiv)->first()===null){
                        return response()->json([
                            'message'=>'Le numéro de compte divisionnaire fournit est inéxistant'
                        ]);
                    }else{
                        if(DB::table('sous_comptes')->where('numero',$request->numero)->orWhere('libelle',$request->libelle)->first()!==null){
                            $sous_compte=DB::table('sous_comptes')->where('numero',$request->numero)->orWhere('libelle',$request->libelle)->first();
                            return response()->json([
                               'message'=>'Un sous compte avec ce numero ou ce libelle existe déjà',
                                'object'=>$sous_compte
                            ]);
                        }else{
                            $sous_compte->numero=$request->numero;
                            $sous_compte->libelle=$request->libelle;
                            $sous_compte->description=$request->description;
                            $sous_compte->compte_divisionnaire=$request->compteDiv;
                            if(substr($sous_compte->numero,0,3)==$sous_compte->compte_divisionnaire){
                                DB::table('sous_comptes')->insert([
                                    'numero'=>$sous_compte->numero,
                                    'libelle'=>$sous_compte->libelle,
                                    'description'=>$sous_compte->description,
                                    'compte_divisionaire'=>$sous_compte->compte_divisionnaire
                                ]);
                                return response()->json([
                                    'message'=>'Sous-compte ajouté avec succes',
                                    'object'=>$sous_compte
                                ]);
                            }else{
                                return response()->json([
                                    'message'=>'Les 3 premiers caractères du numéro de sous-compte doit etre égal au numéro de compte divisionnaire'
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
                'message'=>"Veuillez fournir les informations requises pour la création d'un sous-compte"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sous_compte  $sous_compte
     * @return \Illuminate\Http\Response
     */
    public function show($numero)
    {
        $compte=DB::table('comptes')->whereNumero_compte($numero)->first();
        return response()->json($compte);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sous_compte  $sous_compte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sous_compte $sous_compte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sous_compte  $sous_compte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sous_compte $sous_compte)
    {
        //
    }
}
