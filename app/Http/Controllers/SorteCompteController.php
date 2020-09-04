<?php

namespace App\Http\Controllers;

use App\Sorte_compte;
use Illuminate\Http\Request;

class SorteCompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sortes=Sorte_compte::all();
        return response()->json($sortes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sorte_compte  $sorte_compte
     * @return \Illuminate\Http\Response
     */
    public function show(Sorte_compte $sorte_compte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sorte_compte  $sorte_compte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sorte_compte $sorte_compte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sorte_compte  $sorte_compte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sorte_compte $sorte_compte)
    {
        //
    }
}
