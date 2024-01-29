<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produit extends Model
{
    protected $fillable = ['Name', 'Marque', 'Quantite', 'couleur', 'Prix', 'type', 'reference','description' ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produit) {
            $produit->reference = Str::uuid();
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'vendeur_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class,'categorie_id');
    }
}
