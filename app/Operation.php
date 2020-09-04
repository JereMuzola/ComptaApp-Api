<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable=['ref_op','montant','taux_du_jour','sens','motif','date_op','journal','um','sous_compte_op'];

}
