<?php

namespace App\Http\Controllers;

use App\Compte;
use App\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$comptes=Compte::all();
        $comptes=DB::table('comptes')->join('classes','classes.code','=','comptes.classe')
            ->join('sorte_comptes','sorte_comptes.numero','=','comptes.sorte_compte')
            ->join('type_comptes','type_comptes.numero','=','comptes.type_compte')
            ->orderBy('comptes.numero_compte ')
            ->select('comptes.numero_compte as numero','classes.code as code_classe','comptes.libelle as libelle','classes.libelle as classe','sorte_comptes.libelle as sorte_compte','sorte_comptes.numero as num_s','type_comptes.libelle as type_compte','type_comptes.numero as num_t','comptes.description as description')
            ->get();
        return response()->json($comptes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compte=new Compte();
        $classe=new Classe();
        $data=array();
        if(isset($request)){
            if (isset($request->numero) && isset($request->libelle) && isset($request->classe) && isset($request->type) && isset($request->sorte)) {
                if(strlen($request->numero)==2){
                $compte->numero_compte=$request->numero;
                $compte->libelle=$request->libelle;
                $compte->description=$request->description;
                $compte->sorte_compte=$request->sorte;
                $compte->type_compte=$request->type;
                if(DB::table('classes')->whereCode($request->classe)->first()===null){
                        $data['message']="La classe fournie est inéxistante";
                }else{
                    $compte->classe=$request->classe;
                    $classe=DB::table('classes')->whereCode($request->classe)->first();
                    if (DB::table('comptes')->where('numero_compte',$compte->numero_compte)->orWhere('libelle',$compte->libelle)->first()!==null) {
                        $data['message']="Ce compte existe déjà";
                        $compte=DB::table('comptes')->where('numero_compte',$compte->numero_compte)->orWhere('libelle',$compte->libelle)->first();
                    } else {
                        if (substr($compte->numero_compte,0,1)==$compte->classe){
                            $data['message']="Compte ajouté";
                            DB::table('comptes')->insert(['numero_compte'=>$compte->numero_compte,'libelle'=>$compte->libelle,'classe'=>$compte->classe,'sorte_compte'=>$compte->sorte_compte,'type_compte'=>$compte->type_compte,'description'=>$compte->description]);
                        }else{
                            $data['message']="le premier carectère du numéro doit etre égal au code la classe";
                        }

                    }
                    }
                }else{
                    $data['message']="Le numero de compte ne doit comporter que 2 chiffres";
                }
            }else{
                $data['message']="Au moins une information est manquante";
            }
        }else{
            $data['message']="Veuillez fournir les informations requises pour la création d'un compte";
        }
        return response()->json(['message'=>$data['message'],'compte'=>$compte,'classe'=>$classe]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compte  $compte
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
     * @param  \App\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compte $compte)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compte $compte)
    {
        //
    }
}
