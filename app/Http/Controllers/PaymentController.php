<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function paymentProcess(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $validated = $request->validate([
            'amount' => ['required', 'decimal', 'min:100', 'max:100000'],
            'currency' => ['required', 'string', 'min:3', 'max:3'],
            'source' => ['required'],
            'description' => ['required']
        ]);

        $charge = Charge::create([
            'amount' => $validated['amount'],
            'currency' => $validated['currency'],
            'source' => $validated['source'],
            'description' => $validated['description']
        ]);

        return redirect()->route('payment.success');
    }
}
