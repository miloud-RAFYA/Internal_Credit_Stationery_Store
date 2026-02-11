<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    /** @use HasFactory<\Database\Factories\DepartementFactory> */
    use HasFactory;
    protected $fillable = ['nom'];
    public function manager()
    {
        return $this->hasOne(Manager::class);
    }
    public function employe()
    {
        return $this->hasMany(Employe::class);
    }

    public function commande()
    {
        return $this->hasManyThrough(Commande::class, Employe::class);
    }
}
