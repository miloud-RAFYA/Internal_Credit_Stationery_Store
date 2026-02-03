<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departement extends Model
{
    /** @use HasFactory<\Database\Factories\DepartemetFactory> */
    use HasFactory;
    protected $fillable = [
        'nom'
    ];
    public function employes(){
        return $this->hasMany(Employe::class);
    }
    public function managers(){
        return $this->hasMany(Manager::class);
    }
}
