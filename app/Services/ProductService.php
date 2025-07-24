<?php

namespace App\Services;

use App\Http\Requests\Product\ProductStoreRequest;
use Exception;
use App\Repositories\ProductRespository;

class ProductService
{

    public function __construct(
        public ProductRespository $productRespository
    ) {}

    public function all()
    {

        try {

            // Recuperation de tous les produits
            $products = $this->productRespository->all();

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

    public function find(string $id)
    {
        try {
            $product = $this->productRespository->find($id);

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

    public function create(ProductStoreRequest $request)
    {
        try {
            $data = $request->validated();

            $product = $this->productRespository->create($data);

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
            $product = $this->productRespository->find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produit introuvable',
                ]);
            }

            // Recuperation de la donnée vaidée
            $data = $request->validated();

            $product = $this->productRespository->update($product, $data);

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

    public function delete(string $id)
    {
        try {

            $product = $this->productRespository->find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Prouit introuvable',
                ]);
            }

            //Suppression de la categorie
            $this->productRespository->delete($product);

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
