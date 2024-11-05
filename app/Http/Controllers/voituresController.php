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
            'modele' => 'required',
            'annee' => 'required',
            'valeur' => 'required',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Veuillez remplir tous les champs');
        }

        // Gestion de l'upload de la photo
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        voitures::create([
            'marque' => $request->marque,
            'modele' => $request->modele,
            'annee' => $request->annee,
            'valeur' => $request->valeur,
            'description' => $request->description,
            'photo' => $photoPath,  // Ajout de la photo
        ]);

        return redirect('/')->with('success', 'Voiture ajoutée avec succès');
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
        $validator = Validator::make($request->all(), [
            'marque' => 'required',
            'modele' => 'required',
            'annee' => 'required',
            'valeur' => 'required',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'Veuillez remplir tous les champs');
        }

        $voiture = voitures::findOrFail($id);

        // Gestion de l'upload de la photo
        $photoPath = $voiture->photo;  // Conserver l'ancienne photo si aucune nouvelle image n'est téléchargée
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo
            if ($voiture->photo) {
                Storage::disk('public')->delete($voiture->photo);
            }
            // Sauvegarder la nouvelle photo
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $voiture->update([
            'marque' => $request->marque,
            'modele' => $request->modele,
            'annee' => $request->annee,
            'valeur' => $request->valeur,
            'description' => $request->description,
            'photo' => $photoPath,  // Mise à jour de la photo
        ]);

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
