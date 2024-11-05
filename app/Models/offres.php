<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offres extends Model
{
    use HasFactory;

    protected $fillable = ['prix', 'message', 'voiture_id', 'user_id'];

    //Les relations

    public function voiture()
    {
        return $this->belongsTo(voitures::class, 'voiture_id'); // Utilise 'voiture_id' comme clé étrangère
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
