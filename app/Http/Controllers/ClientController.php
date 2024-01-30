<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Category;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function showAllProducts()
    {
        try {
            $produits = Produit::select(
                    'produits.*',
                    'users.name as vendeur_name',
                    'categories.nomC as category_name'
                )
                ->leftJoin('users', 'produits.vendeur_id', '=', 'users.id')
                ->leftJoin('categories', 'produits.categorie_id', '=', 'categories.id')
                ->get();

            return response()->json(['produits' => $produits], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function showProductsByMarque($marque)
    {
        try {
            $produits = Produit::select(
                    'produits.*',
                    'users.name as vendeur_name',
                    'categories.nomC as category_name'
                )
                ->leftJoin('users', 'produits.vendeur_id', '=', 'users.id')
                ->leftJoin('categories', 'produits.categorie_id', '=', 'categories.id')
                ->where('produits.Marque', $marque)
                ->get();

            return response()->json(['produits' => $produits], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function showProductsByType($type)
{
    try {
        $produits = Produit::where('type', $type)
            ->leftJoin('users', 'produits.vendeur_id', '=', 'users.id')
            ->leftJoin('categories', 'produits.categorie_id', '=', 'categories.id')
            ->select('produits.*', 'users.name as vendeur_name', 'categories.nomC as category_name')
            ->get();

        return response()->json(['produits' => $produits], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function showHomePage()
{
    try {
        $popularProducts = Produit::orderByDesc('nbvente')->limit(8)->get();
        $bestSalaryProduct = Produit::orderByDesc('Prix')->take(8)->get();

        return view('welcome', ['popularProducts' => $popularProducts, 'bestSalaryProduct' => $bestSalaryProduct]);
    } catch (QueryException $e) {
        return view('error')->with('error_message', 'Error fetching products: ' . $e->getMessage());
    }


}
public function showDetail($id)
{
    // Logique pour récupérer les détails du produit en fonction de l'ID
    $product = Produit::find($id);

    // Retourner la vue avec les détails du produit
    return view('client.shopSingle', ['product' => $product]);
}


}
