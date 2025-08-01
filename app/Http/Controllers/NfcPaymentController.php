<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;

class NfcPaymentController extends Controller
{
    public function index()
    {
        return view('nfc.pay');
    }

    public function process(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();

        if ($user->wallet->balance < $request->amount) {
            return redirect()->route('nfc.pay')->with('error', 'Insufficient balance.');
        }

        // Simulate deduction
        $user->wallet->decrement('balance', $request->amount);

        WalletTransaction::create([
            'user_id' => $user->id,
            'type' => 'debit',
            'currency' => 'SAR',
            'amount_original' => $request->amount,
            'amount_sar' => $request->amount,
            'fee_applied' => 0,
            'description' => 'NFC Payment Simulation',
            'status' => 'completed',
        ]);

        return view('nfc.success');
    }
}
