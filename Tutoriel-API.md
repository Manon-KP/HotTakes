# Tutoriel : Adapter le projet sauces avec une API

## 1. Créer le contrôleur API : php artisan make:controller SauceApiController --api

##  2. Adaptez les méthodes (index, store, show, update, destroy) pour renvoyer des réponses JSON

## 3. Définir les routes avec apiResource() (routes/api.php) :

use App\Http\Controllers\SauceController;
Route::apiResource('sauces', SauceController::class);

Ne pas oubliez d'ajouter dans bootstrap/app.php : api: __DIR__.'/../routes/api.php' 

## 4. Tester votre API 

Vous pouvez tester l’API avec un outil comme Postman, par exemple :

- Envoyez une requête GET sur /api/sauces pour vérifier que la liste des sauces est renvoyée correctement.
- Testez l’ajout (POST), la modification (PUT/PATCH) et la suppression (DELETE) d’une sauce.
- Vérifiez que chaque réponse renvoie le bon code HTTP (200) et le contenu attendu au format JSON.