<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaynowCallbackController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $status = $request->status;
        $pollUrl = $request->pollurl;
        $orderId = $request->reference;
        $order = Order::find($orderId);
        $paynowreference = $request->paynowreference;
        $newBalance = 0;
        $previousBalance = 0;

        $transaction = Transaction::find($transactionId);

        // $status = $this->paynow->pollTransaction($pollUrl);

        if ($status == 'Paid' || $status == 'Awaiting Delivery' || $status == 'Delivered') {
            // Update transation status
            $transaction->status = 'paid';
            $transaction->payment_gateway_reference = $paynowreference;
            $transaction->details = 'Load funds via Paynow';
            $transaction->save();

            // Adjust wallet
            $user = User::find($transaction->user_id);
            $reseller = $user->reseller;

            if (is_null($reseller)){
                \Log::error('Reseller not found');
            }

            $wallet = \App\Wallet::where([
                'reseller_id' => $reseller->id,
                'currency_id' => $transaction->currency_id
            ])->first();

            $currency = Currency::find($transaction->currency_id);
            $usd_amount = $transaction->amount / $currency->rate;

            if(is_null($wallet)){
                // create new wallet
                $newBalance = $transaction->amount;
                if (is_null($currency)) {
                    \Log::error('Error while selection currency');
                }

                $wallet = \App\Wallet::create([
                    'reseller_id' => $reseller->id,
                    'usd_balance' => $usd_amount,
                    'amount' => $newBalance,
                    'currency_id' => $transaction->currency_id
                ]);
                
                \Log::info('Wallet created ' . $transaction->id);
            } else {
                // Update wallet
                $previousBalance    =   $wallet->amount;
                $newBalance         =   $previousBalance + $transaction->amount;
                $wallet->amount     =   $newBalance;
                $wallet->save();
                
                \Log::info('Wallet Updated ' . $transaction->id);
            }

            // Log Transaction
            logTransaction($transaction->id, $previousBalance, $newBalance);

            // Trigger Funds Loaded Event
            event(new OrderCompleted($order));

        } else {
           \Log::error('Transaction failed ' . $transaction->id);
        }
    }
}
