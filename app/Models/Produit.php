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
        'stock',
        'description',
        'image_produit',
        'est_premuim'
    ];
    protected $casts = [
        'est_premuim' => 'boolean',
    ];
    public function ligneCommande()
    {
        return $this->hasMany(LigneCommande::class);
    }
}
