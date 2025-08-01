<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MadaCard;
use Illuminate\Support\Facades\Auth;

class MadaCardController extends Controller
{
    public function create()
    {
        return view('mada.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->madaCard) {
            return redirect()->route('dashboard')->with('error', 'You already have a Mada Card.');
        }

        $card = MadaCard::create([
            'user_id' => $user->id,
            'card_number' => $this->generateCardNumber(),
            'cvv' => rand(100, 999),
            'expiry_date' => now()->addYears(3)->format('m/y'),
            'status' => 'active',
        ]);

        return redirect()->route('dashboard')->with('add-mada-success', 'Mada Card created successfully.');
    }

    private function generateCardNumber()
    {
        return implode('', [
            rand(4000,4999), rand(1000,9999), rand(1000,9999), rand(1000,9999)
        ]);
    }
}
