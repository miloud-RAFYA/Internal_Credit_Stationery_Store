<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    /** @use HasFactory<\Database\Factories\ProduitFactory> */
    use HasFactory;
    protected $fillable = [
        'nom',
        'prix_tokens',
        'qte',
        'description',
        'image',
        'est_premuim'
    ];
     public function ligneCommande()
    {
        return $this->hasMany(LigneCommande::class);
    }
}
