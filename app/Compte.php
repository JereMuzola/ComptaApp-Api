<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    protected $fillable=['numero_compte','libelle','classe','sorte_compte','type_compte'];

}
