<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Resources\CategoryRessource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            // Recuperation de toutes les categorie
            $categories = CategoryRessource::collection(Category::latest()->get());

            return response()->json([
                'success' => true,
                'message' => 'La liste des catégories',
                'data' => $categories
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

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Categorie introuvable',
            ]);
        }


        return response()->json([
            'success' => true,
            'message' => 'Catégorie trouvée',
            'data' => $category
        ]);
    }

    public function store(CategoryStoreRequest $request)
    {
        try {
            // Recuperation de la donnée vaidée
            $data = $request->validated();

            //Creation de la categorie
            $Category = Category::create($data);

            // Erreur lors de l'insertion
            if (!$Category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur survenue lors de l\'insertion',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Catégorie crée',
                'data' => $Category
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur survenue au niveau du serveur',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(CategoryStoreRequest $request, string $id)
    {
        try {

            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Categorie introuvable',
                ]);
            }

            // Recuperation de la donnée vaidée
            $data = $request->validated();

            $category->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Catégorie modifiée',
                'data' => $category
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

            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Categorie introuvable',
                ]);
            }

            //Suppression de la categorie
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Catégorie supprimée',
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
