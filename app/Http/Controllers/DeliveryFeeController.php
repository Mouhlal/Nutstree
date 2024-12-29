<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryFee;
use Illuminate\Support\Str;

class DeliveryFeeController extends Controller
{
    // Affiche la liste des frais de livraison
    public function index()
    {
        $fees = DeliveryFee::all();
        return view('dashboard.delivery', compact('fees'));
    }
    // Dans votre contrôleur


    // Affiche le formulaire pour ajouter un frais
    public function create()
    {
        return view('dashboard.delivery');
    }

    // Enregistre un nouveau frais de livraison
    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
        ]);

        $city = ucfirst(strtolower($request->city));
        // Mettre uniquement la première lettre en majuscule

        DeliveryFee::create([
            'city' => $city,
            'fee' => $request->fee,
        ]);

        return redirect()->route('delivery_fees.index')->with('success', 'Frais de livraison ajouté avec succès.');
    }

    public function edit($id)
    {
        $fee = DeliveryFee::findOrFail($id);
        return view('dashboard.editDelivery', compact('fee'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'city' => 'required|string|max:255',
            'fee' => 'required|numeric|min:0',
        ]);

        $fee = DeliveryFee::findOrFail($id);
        $city = ucfirst(strtolower($request->city));
        $fee->update([
            'city' => $city,
            'fee' => $request->fee,
        ]);

        return redirect()->route('delivery_fees.index')->with('success', 'Frais de livraison mis à jour avec succès.');
    }

    // Supprime un frais de livraison
    public function destroy($id)
    {
        $fee = DeliveryFee::findOrFail($id);
        $fee->delete();

        return redirect()->route('delivery_fees.index')->with('success', 'Frais de livraison supprimé avec succès.');
    }

    


}


