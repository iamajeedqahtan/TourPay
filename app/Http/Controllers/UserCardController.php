<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCard;
use Illuminate\Support\Facades\Auth;

class UserCardController extends Controller
{
    public function create()
    {
        return view('cards.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'card_number' => ['required', 'digits:16'],
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\\/\\d{2}$/'], // MM/YY
            'cardholder_name' => ['required', 'string', 'max:255'],
            'cvv' => ['nullable', 'digits:3'], // Optional CVV
        ]);

        UserCard::create([
            'user_id' => Auth::id(),
            'card_number' => $this->maskCard($validated['card_number']),
            'expiry_date' => $validated['expiry_date'],
            'cardholder_name' => $validated['cardholder_name'],
            'cvv' => $validated['cvv'], // Optional CVV
            'is_default' => false,
        ]);

        return redirect()->route('dashboard')->with('add-credit-success', 'Card saved successfully.');
    }

    protected function maskCard($number)
    {
        return '**** **** **** ' . substr($number, -4);
    }

    public function destroy(UserCard $card)
    {
        // Make sure the user owns the card
        if ($card->user_id !== Auth::id()) {
            abort(403);
        }

        $card->delete();

        return redirect()->route('dashboard')->with('success', 'Card deleted successfully.');
    }
}
