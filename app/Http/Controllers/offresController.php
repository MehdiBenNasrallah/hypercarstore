<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\offres;
use App\Models\voitures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class offresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validation des données
    $validator = Validator::make($request->all(), [
        'prix' => 'required|numeric',
        'message' => 'required',
        'voiture_id' => 'required|exists:voitures,id', // Assurez-vous que l'ID de la voiture existe
        'user_id' => 'required|exists:users,id', // Assurez-vous que l'ID de l'utilisateur existe
    ]);

    if ($validator->fails()) {
        return redirect()->back()->with('warning', 'Veuillez remplir tous les champs correctement');
    }

    // Création de l'offre
    offres::create([
        'prix' => $request->prix,
        'message' => $request->message,
        'voiture_id' => $request->voiture_id,
        'user_id' => $request->user_id,
    ]);

    return redirect()->back()->with('success', 'Offre créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offre = offres::findOrfail($id);
        $offre->delete();

        return redirect()->back();
    }
}
