<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Produit;

class VendeurController extends Controller
{
    public function createCategory(Request $request)
    {
        $request->validate([
            'nomC' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'nomC' => $request->nomC,
        ]);

        return response()->json(['message' => 'Catégorie créée avec succès', 'category' => $category], 201);
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'Marque' => 'required|string|max:255',
            'Quantite' => 'required|string|max:255',
            'couleur' => 'required|json',
            'Prix' => 'required|integer',
            'type' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = $request->file('image')->store('public/images');
        $imagePath = str_replace('public/', 'storage/', $imagePath);

        $produit = Produit::create([
            'Name' => $request->Name,
            'Marque' => $request->Marque,
            'Quantite' => $request->Quantite,
            'couleur' => json_decode($request->couleur),
            'Prix' => $request->Prix,
            'type' => $request->type,
            'image' => $imagePath,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['message' => 'Produit créé avec succès', 'produit' => $produit], 201);
    }

    public function showCategories()
    {
        $categories = Category::all();

        return response()->json(['categories' => $categories], 200);
    }

    public function showProducts()
    {
        $produits = Produit::all();

        return response()->json(['produits' => $produits], 200);
    }
}
