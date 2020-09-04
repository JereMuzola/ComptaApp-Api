<?php

namespace App\Http\Controllers;

use App\Type_compte;
use Illuminate\Http\Request;

class TypeCompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types=Type_compte::all();
        return response()->json($types);
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
     * @param  \App\Type_compte  $type_compte
     * @return \Illuminate\Http\Response
     */
    public function show(Type_compte $type_compte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type_compte  $type_compte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type_compte $type_compte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type_compte  $type_compte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type_compte $type_compte)
    {
        //
    }
}
