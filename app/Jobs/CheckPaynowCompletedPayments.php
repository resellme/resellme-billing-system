<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use Paynow\Payments\Paynow;

class CheckPaynowCompletedPayments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::info('Check completed paynow payments');
        $paynow = new Paynow(
            env('PAYNOW_INTEGRATION_ID'),
            env('PAYNOW_INTEGRATION_KEY'),
            env('PAYNOW_RETURN_URL'),
            env('PAYNOW_RESULT_URL')
        );

        $pendingOrders = Order::where('status', 'pending')->get();

        foreach ($pendingOrders as $key => $order) {
            // Poll URL
            $status = $paynow->pollTransaction($order->paynow_poll_url);

            if ($status == 'Paid' || $status == 'Awaiting Delivery' || $status == 'Delivered') {
            // Update transation status
            $order->status = 'completed';
            $order->save();

            // Trigger Funds Loaded Event
            event(new OrderCompleted($order));

            } else {
                $order->status = 'failed';
                $order->save();
               \Log::error('Transaction failed ' . $order->id . ' Status: ' . $status) ;
            }
        }
    }
}
