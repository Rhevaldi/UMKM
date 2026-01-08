<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;    

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer','items.product')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::where('is_active',1)->get();
        return view('orders.create', compact('customers','products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'quantities' => 'required|array'
        ]);

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'order_code' => 'ORD'.time(),
            'total_amount' => 0,
            'status' => 'pending',
            'order_date' => now()
        ]);

        $total = 0;
        foreach($request->products as $index => $product_id){
            $product = Product::findOrFail($product_id);
            $qty = $request->quantities[$index];
            $subtotal = $product->price * $qty;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $product->price,
                'subtotal' => $subtotal
            ]);

            $total += $subtotal;
        }

        $order->update(['total_amount' => $total]);

        return redirect()->route('orders.index')->with('success','Order berhasil dibuat');
    }

    public function show(Order $order)
    {
        $order->load('customer','items.product','payment');
        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success','Order dihapus');
    }
}

