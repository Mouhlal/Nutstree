<?php

namespace App\Http\Controllers;

use App\Mail\PromoCodeMail;
use App\Models\CodePromo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CodePromoController extends Controller
{
   public function index(){
         $codes = CodePromo::all();
         return view('dashboard.codePromo',compact('codes'));
   }
   public function create(){
        return view('dashboard.codePromo');
    }
    public function store(Request $request){
        $att = $request->validate([
            'code' => 'required',
            'discount' => 'required',
            'valid_from' => 'required',
            'valid_until' => 'required',
            'usage_limit' => 'required',
        ]);

        CodePromo::create($att);
        return redirect()->route('codepromo.index')->with('success','Code promo ajouté avec succès');
    }
    public function edit($id){
        $code = CodePromo::find($id);
        return view('dashboard.editCode',compact('code'));
    }
    public function update(Request $request,$id){
        $att = $request->validate([
            'code' => 'nullable',
            'discount' => 'nullable',
            'valid_from' => 'nullable',
            'valid_until' => 'nullable',
            'usage_limit' => 'nullable',
        ]);
        CodePromo::find($id)->update($att);
        return redirect()->route('codepromo.index')->with('success','Code promo modifié avec succès');
    }
    public function destroy($id){
        CodePromo::find($id)->delete();
        return redirect()->route('codepromo.index')->with('success','Code promo supprimé avec succès');
    }

    public function sendPromo()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Vous devez être connecté pour recevoir le code promo.'], 401);
        }

        $email = Auth::user()->email;

        $promoCode = CodePromo::where('valid_until', '>=', now())->inRandomOrder()->first();

        // Vérifier si un code promo valide a été trouvé
        if (!$promoCode) {
            return response()->json(['error' => 'Aucun code promo valide disponible.'], 404);
        }
        Mail::to($email)->send(new PromoCodeMail($promoCode));

        return response()->json(['success' => 'Le code promo a été envoyé avec succès à votre email.'], 200);
    }
    public function applyPromo(Request $request)
    {
        // Validation du code promo
        $request->validate([
            'code' => 'required|string'
        ]);

        // Vérifier si le sous-total existe dans la session
        $subtotal = session()->get('subtotal');
        if ($subtotal === null || $subtotal == 0) {
            return redirect()->back()->with('error', 'Le sous-total n\'est pas disponible.');
        }

        // Chercher le code promo dans la base de données
        $promoCode = CodePromo::where('code', $request->code)
            ->where('valid_until', '>=', now()) // Vérifier si le code est encore valide
            ->first();

        if (!$promoCode) {
            return redirect()->back()->with('error', 'Code promo invalide ou expiré.');
        }

        // Appliquer la réduction
        $discount = $promoCode->discount;
        $deliveryFee = session()->get('deliveryFee', 0);  // Frais de livraison

        // Calcul de la réduction
        $discountAmount = ($discount / 100) * $subtotal;
        $newSubtotal = $subtotal - $discountAmount;

        // Stocker les nouvelles valeurs dans la session
        session()->put('newSubtotal', $newSubtotal);
        session()->put('discountAmount', $discountAmount);
        session()->put('promo_code', $request->code);

        $newTotal = $newSubtotal + $deliveryFee;
        session()->put('total', $newTotal);

        return redirect()->back()->with('success', 'Code promo appliqué avec succès.');
    }


}
