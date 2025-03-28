<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Sauce;
use Illuminate\Support\Facades\File;

class SauceApiController extends Controller
{
    /**
     * GET /sauces
     * Affiche la liste des sauces.
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json(Sauce::latest()->paginate(9), 200);
        } else {
            $sauces = Sauce::latest()->paginate(9);
            return view('sauces.index', compact('sauces'));
        }
    }

    /**
     * GET /sauces/create
     * Affiche les informations nécessaires à la création d'une sauce.
     */
    public function create(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'fields' => [
                    'name'         => 'string',
                    'manufacturer' => 'string',
                    'description'  => 'string',
                    'mainPepper'   => 'string',
                    'imageUrl'     => 'file (image, optionnel)',
                    'heat'         => 'integer (1-10)'
                ],
                'message' => 'Utilisez ces champs pour créer une nouvelle sauce via POST /api/sauces'
            ], 200);
        } else {
            return view('sauces.create');
        }
    }

    /**
     * POST /sauces
     * Enregistre une nouvelle sauce.
     */
    public function store(Request $request, Sauce $sauce)
    {
        $request->validate([
            'name'         => 'required|string',
            'manufacturer' => 'required|string',
            'description'  => 'required|string',
            'mainPepper'   => 'required|string',
            'imageUrl'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'heat'         => 'required|integer|min:1|max:10',
        ]);

        $data = $request->only(['name', 'manufacturer', 'description', 'mainPepper', 'heat']);

        // Gestion de l'upload de l'image, si présente
        if ($request->hasFile('imageUrl')) {
            $imageName = time() . '.' . $request->imageUrl->extension();
            $request->imageUrl->move(public_path('images'), $imageName);
            $data['imageUrl'] = 'images/' . $imageName;
        }

        // Création de la sauce
        $data['userId'] = Auth::id();
        $sauce = Sauce::create($data);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Sauce ajoutée avec succès',
                'sauce'   => $sauce
            ], 201);
        } else {
            return redirect()->route('sauces.index')->with('success', 'Sauce ajoutée !');
        }
    }

    /**
     * GET /sauces/{sauce}
     * Affiche une sauce spécifique.
     */
    public function show(Request $request, Sauce $sauce)
    {
        if ($request->expectsJson()) {
            return response()->json($sauce, 200);
        } else {
            return view('sauces.show', compact('sauce'));
        }
    }

    /**
     * GET /sauces/{sauce}/edit
     * Affiche les données actuelles d'une sauce pour modification.
     */
    public function edit(Request $request, Sauce $sauce)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'sauce' => $sauce,
                'message' => 'Modifiez ces champs et envoyez une requête PUT/PATCH à /api/sauces/' . $sauce->id
            ], 200);
        } else {
            return view('sauces.edit', compact('sauce'));
        }
    }

    /**
     * PUT/PATCH /sauces/{sauce}
     * Met à jour une sauce.
     */
    public function update(Request $request, Sauce $sauce)
    {
        $request->validate([
            'name'         => 'required|string',
            'manufacturer' => 'required|string',
            'description'  => 'required|string',
            'mainPepper'   => 'required|string',
            'imageUrl'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'heat'         => 'required|integer|min:1|max:10',
        ]);

        $data = $request->only(['name', 'manufacturer', 'description', 'mainPepper', 'heat']);

        // Gestion du changement d'image
        if ($request->hasFile('imageUrl')) {
            if (File::exists(public_path($sauce->imageUrl))) {
                File::delete(public_path($sauce->imageUrl));
            }
            $imageName = time() . '.' . $request->imageUrl->extension();
            $request->imageUrl->move(public_path('images'), $imageName);
            $data['imageUrl'] = 'images/' . $imageName;
        }

        $sauce->update($data);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Sauce mise à jour avec succès',
                'sauce'   => $sauce
            ], 200);
        } else {
            return redirect()->route('sauces.index')->with('success', 'Sauce mise à jour avec succès');
        }
    }

    /**
     * DELETE /sauces/{sauce}
     * Supprime une sauce.
     */
    public function destroy(Request $request, Sauce $sauce)
    {
        if (File::exists(public_path($sauce->imageUrl))) {
            File::delete(public_path($sauce->imageUrl));
        }
        $sauce->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Sauce supprimée avec succès'], 200);
        } else {
            return redirect()->route('sauces.index')->with('error', 'Sauce supprimée.');
        }
    }

    /**
     * POST /sauces/{sauce}/like
     * Gère le like d'une sauce.
     */
    public function like(Request $request, Sauce $sauce)
    {
        $userId = Auth::id();
        $usersLiked = json_decode($sauce->usersLiked, true) ?? [];
        $usersDisliked = json_decode($sauce->usersDisliked, true) ?? [];

        if (!in_array($userId, $usersLiked)) {
            if (($key = array_search($userId, $usersDisliked)) !== false) {
                unset($usersDisliked[$key]);
                $sauce->dislikes--;
            }

            $usersLiked[] = $userId;
            $sauce->likes++;
            $sauce->usersLiked = json_encode(array_values($usersLiked));
            $sauce->usersDisliked = json_encode(array_values($usersDisliked));
            $sauce->save();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Sauce likée avec succès',
                'sauce'   => $sauce
            ], 200);
        } else {
            return redirect()->route('sauces.index')->with('success', 'Sauce likée !');
        }
    }

    /**
     * POST /sauces/{sauce}/dislike
     * Gère le dislike d'une sauce.
     */
    public function dislike(Request $request, Sauce $sauce)
    {
        $userId = Auth::id();
        $usersLiked = json_decode($sauce->usersLiked, true) ?? [];
        $usersDisliked = json_decode($sauce->usersDisliked, true) ?? [];

        if (!in_array($userId, $usersDisliked)) {
            if (($key = array_search($userId, $usersLiked)) !== false) {
                unset($usersLiked[$key]);
                $sauce->likes--;
            }

            $usersDisliked[] = $userId;
            $sauce->dislikes++;
            $sauce->usersLiked = json_encode(array_values($usersLiked));
            $sauce->usersDisliked = json_encode(array_values($usersDisliked));
            $sauce->save();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Sauce dislikée avec succès',
                'sauce'   => $sauce
            ], 200);
        } else {
            return redirect()->route('sauces.index')->with('success', 'Sauce dislikée !');
        }
    }

    /**
     * GET /my-sauces
     * Affiche les sauces créées par l'utilisateur connecté.
     */
    public function mySauces(Request $request)
    {
        $sauces = Sauce::where('userId', Auth::id())->latest()->paginate(9);
        if ($request->expectsJson()) {
            return response()->json($sauces, 200);
        } else {
            return view('sauces.my-sauces', compact('sauces'));
        }
    }
}
