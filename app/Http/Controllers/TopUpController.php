<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Currency;
use App\Models\WalletTransaction;

class TopUpController extends Controller
{
    public function create()
    {
        $cards = Auth::user()->cards;
        $currencies = Currency::all();

        return view('wallet.topup', compact('cards', 'currencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'currency_id' => 'required|exists:currencies,id',
            'card_id' => 'required|exists:user_cards,id',
        ]);

        $user = Auth::user();
        $currency = Currency::find($request->currency_id);
        $amount_original = $request->amount;
        $rate = $currency->rate_to_sar;

        $sar_amount = $amount_original * $rate;
        $fee = $currency->fixed_fee + ($sar_amount * $currency->percentage_fee / 100);
        $final_amount = $sar_amount - $fee;

        // Add to wallet balance
        $user->wallet->increment('balance', $final_amount);

        WalletTransaction::create([
            'user_id' => $user->id,
            'type' => 'credit',
            'currency' => $currency->code,
            'amount_original' => $amount_original,
            'amount_sar' => $final_amount,
            'fee_applied' => $fee,
            'description' => 'Wallet Top-up via Card (Simulated)',
            'status' => 'completed',
        ]);

        return redirect()->route('dashboard')->with('success', 'Wallet topped up successfully.');
    }
}
