<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\voitures;
use Illuminate\Support\Facades\Validator;

class voituresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voitures = voitures::all();
        return view('voitures.index', compact('voitures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voitures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'marque' => 'required',
            'annee' => 'required',
            'modele' => 'required',
            'valeur' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) 
        {
            return redirect()->back()->with('warning', 'Veuillez remplir tous les champs'); 
        }
        else 
        {
            voitures::create($request->all());
            return redirect('/')->with('success', 'Voiture ajoutée avec succès');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voiture = voitures::with('offres')->findOrFail($id);
        return view('voitures.show', compact('voiture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voiture = voitures::findOrfail($id);
        return view('voitures.edit', compact('voiture'));
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
        voitures::findOrfail($id)->update($request->all());
        return redirect('/')->with('success', 'Voiture modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voiture = voitures::findOrFail($id);
        $voiture->delete();
        return redirect('/')->with('success', 'Voiture supprimée avec succès');
    }
}
