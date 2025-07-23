<?php

namespace App\Http\Controllers\Api\Admin;

use Exception;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\ProductRessource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {

            // Recuperation de tous les produits
            $products = ProductRessource::collection(Product::latest()->get());

            return response()->json([
                'success' => true,
                'message' => 'La liste des produits',
                'data' => $products
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur survenue au niveau du serveur',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function show(string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produit introuvable',
                ]);
            }


            return response()->json([
                'success' => true,
                'message' => 'Produit trouvé',
                'data' => $product
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur survenue au niveau du serveur',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function store(ProductStoreRequest $request)
    {
        try {
            $data = $request->validated();

            $product = Product::create($data);

            // Erreur lors de l'insertion
            if (!$product) {
                return response()->json([
                    'sucess' => false,
                    'message' => 'Erreur survenue lors de l\'insertion',
                ]);
            }

            return response()->json([
                'sucess' => true,
                'message' => 'Produit crée',
                'data' => $product
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur survenue au niveau du serveur',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(ProductStoreRequest $request, string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produit introuvable',
                ]);
            }

            // Recuperation de la donnée vaidée
            $data = $request->validated();

            $product->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Produit modifié',
                'data' => $product
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur survenue au niveau du serveur',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(string $id) {
        try {

            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Prouit introuvable',
                ]);
            }

            //Suppression de la categorie
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produit supprimé',
                'data' => []
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur survenue au niveau du serveur',
                'error' => $e->getMessage()
            ]);
        }
    }
}
