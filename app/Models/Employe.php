<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeFactory> */
    use HasFactory;
    protected $fillable = [
        'token',
        'user_id',
        'departement_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
