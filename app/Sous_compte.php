<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sous_compte extends Model
{
    protected $fillable=['numero','libelle','description','compte_divisionnaire'];
}
