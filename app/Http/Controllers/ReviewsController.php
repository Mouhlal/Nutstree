<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function storeReview(Request $request, $productId)
    {
        // Validation des données
        $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Création de la critique
        $review = new Reviews();
        $review->user_id = Auth::id();
        $review->produit_id = $productId;
        $review->content = $request->input('content');
        $review->rating = $request->input('rating');
        $review->save();
        return redirect()->route('prod.details', ['id' => $productId])
                         ->with('success', 'Votre avis a été ajouté avec succès !');
    }
}
