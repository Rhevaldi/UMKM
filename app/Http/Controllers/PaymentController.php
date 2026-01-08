<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        return view('payments.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        $request->validate([
            'payment_method' => 'required',
        ]);

        
        $payment = Payment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'qris_ref' => $request->qris_ref,
            'payment_status' => 'success',
            'paid_at' => now(),
        ]);

        // Update product stock saat pembayaran berhasil
        foreach($order->items as $item){
            $product = $item->product;
            $product->stock = max(0, $product->stock - $item->quantity);
            $product->save();
        }


        // Update order status
        $order->update(['status'=>'paid']);

        return redirect()->route('orders.index')->with('success','Pembayaran berhasil');
    }
}

