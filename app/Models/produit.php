<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produit extends Model
{
    protected $fillable = ['Name', 'Marque', 'Quantite', 'couleur', 'Prix','reference','description' , 'image' ,'categorie_id','vendeur_id','type_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produit) {
            $produit->reference = Str::uuid();
            $produit->nbvente = 0;
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'vendeur_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Category::class,'categorie_id');
    }
}
