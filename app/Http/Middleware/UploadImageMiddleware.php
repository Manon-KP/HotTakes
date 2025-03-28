<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadImageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si la requête contient un fichier
        if (!$request->hasFile('image')) {
            return back()->with('error', 'Aucun fichier trouvé dans la requête.');
        }

        // Récupérer le fichier
        $file = $request->file('image');

        // Liste des types MIME autorisés
        $allowedMimeTypes = [
            'image/jpeg',
            'image/png',
            'image/jpg',
            'image/webp',
        ];

        // Liste des extensions autorisées
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        // Vérifier le type MIME du fichier (on exclut le PDF ici)
        if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
            return back()->with('error', 'Only
            JPEG, PNG, JPG, WEBP are allowed.');
        }
        // Vérifier l'extension du fichier
        $fileExtension = $file->getClientOriginalExtension();
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            return back()->with('error', 'Only
            JPEG, PNG, JPG, WEBP are allowed.');
        }
        // Si tout est valide, continuer la requête
        return $next($request);
    }
}
