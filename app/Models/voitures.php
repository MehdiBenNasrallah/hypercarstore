<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voitures extends Model
{
    use HasFactory;

    protected $fillable = ['marque', 'annee', 'modele', 'valeur', 'description', 'photo'];

    public function offres()
    {
        return $this->hasMany(offres::class, 'voiture_id'); // Utilise 'voiture_id' comme clé étrangère
    }
    
}
