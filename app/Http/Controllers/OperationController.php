<?php

namespace App\Http\Controllers;

use App\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $list=DB::table('operations')->join('journals','journals.code_journal','=','operations.journal')
          ->join('unite_monetaires','unite_monetaires.numero','=','operations.journal')
           ->join('sous_comptes','sous_comptes.numero','=','operations.sous_compte_op')
           ->join('activites','activites.num_activite','=','journals.activite')
           ->select('ref_op','montant','taux_du_jour','sens','motif','date_op','activites.libelle as journal',"unite_monetaires.libelle as 'Unité monetaire' ")->get();

            foreach ($list as $item){
                if($item->sens=='debit'){
                    $item->montant_debit=$item->montant;
                    $item->montant_credit=0;
                }else{
                    $item->montant_credit=$item->montant;
                    $item->montant_debit=0;
                }
            }
            return response()->json([
               'data'=>$list
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset($request)){
            if(isset($request->ref_op) && isset($request->montant) && isset($request->taux_du_jour) && isset($request->sens) && isset($request->motif) && isset($request->date_op) && isset($request->journal) && isset($request->um) && isset($request->sous_compte_op)){
                $operation=new Operation();
                $operation->ref_op=$request->ref_op;
                $operation->montant=$request->montant;
                $operation->taux_du_jour=$request->taux_du_jour;
                $operation->sens=$request->sens;
                $operation->motif=$request->motif;
                $operation->date_op=$request->date_op;
                $operation->journal=$request->journal;
                $operation->um=$request->um;
                $operation->sous_compte_op=$request->sous_compte_op;
                DB::table('operations')->insert([
                    'ref_op'=>$operation->ref_op,
                    'montant'=>$operation->montant,
                    'taux_du_jour'=>$operation->taux_du_jour,
                    'sens'=>$operation->sens,
                    'motif'=>$operation->motif,
                    'date_op'=>$operation->date_op,
                    'journal'=>$operation->journal,
                    'um'=>$operation->um,
                    'sous_compte_op'=>$operation->sous_compte_op
                ]);

                return response()->json([
                    'message'=>'Opération archivée',
                    'data'=>$operation
                ]);

            }else{
                return response()->json([
                    'message'=>'Fournissez toutes les paramètres SVP'
                ]);
            }
        }else{
            return response()->json([
                'message'=>'la requete ne doit pas etre vide'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function show($ref_op)
    {
        $list=DB::table('operations')->join('journals','journals.code_journal','=','operations.journal')
            ->join('unite_monetaires','unite_monetaires.numero','=','operations.journal')
            ->join('sous_comptes','sous_comptes.numero','=','operations.sous_compte_op')
            ->join('activites','activites.num_activite','=','journals.activite')
            ->select('ref_op','montant','taux_du_jour','sens','motif','date_op','activites.libelle as journal',"unite_monetaires.libelle as 'Unité monetaire' ")->where(['ref_op'=>$ref_op])->get();
        foreach ($list as $item){
            if($item->sens=='debit'){
                $item->montant_debit=$item->montant;
                $item->montant_credit=0;
            }else{
                $item->montant_credit=$item->montant;
                $item->montant_debit=0;
            }
        }

        return response()->json([
           'data'=>$list
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operation $operation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operation $operation)
    {
        //
    }
    public function journals(){
        $list=DB::table('journals')->join('activites','activites.num_activite','=','journals.activite')
        ->select('code_journal','libelle','description')->get();
        return response()->json([
           'data'=>$list
        ]);
    }
}
