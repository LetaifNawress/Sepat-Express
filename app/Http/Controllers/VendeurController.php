<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Type;
use App\Models\Produit;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
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



public function store(Request $request)
{
    // Validation des données du formulaire (à adapter selon vos besoins)
    $request->validate([
        'Name' => 'required|string',
        'Marque' => 'required|string',
        'Quantite' => 'required|string',
        'couleur' => 'required|string',
        'description' => 'required|string',
        'Prix' => 'required|integer',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:204800',
        // Ajoutez d'autres règles de validation selon vos besoins
    ]);

    // Récupérer les données du formulaire
    $requestData = $request->all();

    // Manipulation de l'image et stockage
    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $imagePath = $image->storeAs('images', $imageName, 'public');
    $requestData["image"] = '/storage/' . $imagePath;

    // Ajouter l'id du vendeur actuellement connecté
    $requestData["vendeur_id"] = 2;

    // Créer le produit
    Produit::create($requestData);

   
}

//update d'un produit 

public function update(Request $request, $id)
{
    // Validation des données du formulaire (à adapter selon vos besoins)
    $request->validate([
        'Name' => 'required|string',
        'Marque' => 'required|string',
        'Quantite' => 'required|string',
        'couleur' => 'required|string',
        'description' => 'required|string',
        'Prix' => 'required|integer',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',
        // Ajoutez d'autres règles de validation selon vos besoins
    ]);

    // Récupérer les données du formulaire
    $requestData = $request->all();

    // Vérifier si une nouvelle image a été téléchargée
    if ($request->hasFile('image')) {
        // Manipulation de la nouvelle image et mise à jour du chemin d'image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('images', $imageName, 'public');
        $requestData["image"] = '/storage/' . $imagePath;
    }

    // Mise à jour du produit dans la base de données
    Produit::findOrFail($id)->update($requestData);

    // Redirection ou autre logique après la mise à jour
    return redirect()->route('nom.de.votre.route');
}





public function create()
{
    $categories = Category::all();
    $types = Type::all();

    return view('vendeur.product.addProduct', compact('categories', 'types'));
}

}
