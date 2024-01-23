<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CommandeProduit extends Model
{
    protected $table = 'commande_produit';
    protected $fillable = ['commande_id', 'produit_id', 'quantite', 'prixT'];
}