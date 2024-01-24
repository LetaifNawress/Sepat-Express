<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Produit;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VendeurController extends Controller
{
    public function createCategory(Request $request)
    {
        try {
            $request->validate([
                'nomC' => 'required|string|max:255',
            ]);

            $category = Category::create([
                'nomC' => $request->nomC,
            ]);

            return response()->json(['message' => 'Catégorie créée avec succès', 'category' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createProduct(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'Name' => 'required|string|max:255',
                'Marque' => 'required|string|max:255',
                'Quantite' => 'required|string|max:255',
                'couleur' =>'required|string|max:255',
                'Prix' => 'required|integer',
                'type' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'category_id' => 'required|exists:categories,id',
                'vendeur_id' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            // Upload de l'image vers le stockage
            $imagePath = $request->file('image')->store('public/images');
            $imagePath = str_replace('public/', 'storage/', $imagePath);

            // Création du produit
            $produit = Produit::create([
                'Name' => $request->Name,
                'Marque' => $request->Marque,
                'Quantite' => $request->Quantite,
                'couleur' => $request->couleur,
                'Prix' => $request->Prix,
                'type' => $request->type,
                'image' => $imagePath,
                'category_id' => $request->category_id,
                'vendeur_id' => $request->vendeur_id,
            ]);

            return response()->json(['message' => 'Produit créé avec succès', 'produit' => $produit], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function showCategories()
    {
        try {
            $categories = Category::all();
            return response()->json(['categories' => $categories], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showProducts()
    {
        try {
            $produits = Produit::all();
            return response()->json(['produits' => $produits], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function showProductsByVendeur($vendeurId)
{
    try {
        // Récupérer les produits liés à un vendeur spécifique
        $produits = Produit::where('vendeur_id', $vendeurId)->get();

        return response()->json(['produits' => $produits], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
