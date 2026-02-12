<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    /** @use HasFactory<\Database\Factories\CommandeFactory> */
    use HasFactory;
    protected $fillable = [
        'montant_tokens',
        'status',
        'user_id'
    ];
    public function ligneCommande()
    {
        return $this->hasMany(LigneCommande::class);
    }
    public function estPremium() {
    return $this->ligneCommande()->whereHas('produits', function($query) {
        $query->where('est_premuim', true);
    })->exists();
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
