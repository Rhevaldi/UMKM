<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /* ===============================
       ADMIN ORDER
    =============================== */

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

        DB::transaction(function () use ($request) {

            $order = Order::create([
                'customer_id' => $request->customer_id,
                'order_code' => 'ORD'.time(),
                'total_amount' => 0,
                'status' => 'pending',
                'order_date' => now()
            ]);

            $total = 0;

            foreach ($request->products as $index => $product_id) {

                $product = Product::findOrFail($product_id);
                $qty = $request->quantities[$index];

                if ($product->stock < $qty) {
                    throw new \Exception("Stok {$product->name} tidak cukup.");
                }

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
        });

        return redirect()->route('orders.index')
            ->with('success','Order berhasil dibuat');
    }

    public function show(Order $order)
    {
        $order->load('customer','items.product','payment');
        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')
            ->with('success','Order dihapus');
    }


    /* ===============================
       WHATSAPP ADMIN
    =============================== */

    public function whatsapp(Order $order)
    {
        $order->load('customer','items.product');

        $phone = preg_replace('/[^0-9]/','',$order->customer->phone);

        if (substr($phone,0,1) == '0') {
            $phone = '62'.substr($phone,1);
        }

        $message = "Halo {$order->customer->name}\n\n";
        $message .= "Detail pesanan Anda:\n\n";

        foreach ($order->items as $item) {
            $message .= "- {$item->product->name} x{$item->quantity} = Rp "
                        .number_format($item->subtotal,0,',','.')."\n";
        }

        $message .= "\nTotal: Rp ".number_format($order->total_amount,0,',','.');
        $message .= "\nSilakan lakukan pembayaran.";

        return redirect("https://wa.me/{$phone}?text=".urlencode($message));
    }


    /* ===============================
       FRONTEND ORDER (TANPA LOGIN)
    =============================== */

    public function storePublic(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'products' => 'required|array',
            'quantities' => 'required|array'
        ]);

        return DB::transaction(function () use ($request) {

            // Format nomor WA
            $phone = preg_replace('/[^0-9]/','',$request->phone);

            if (substr($phone,0,1) == '0') {
                $phone = '62'.substr($phone,1);
            }

            // Simpan / ambil customer
            $customer = Customer::firstOrCreate(
                ['phone' => $phone],
                [
                    'name' => $request->name,
                    'address' => '-'
                ]
            );

            // Buat order
            $order = Order::create([
                'customer_id' => $customer->id,
                'order_code' => 'ORD'.time(),
                'total_amount' => 0,
                'status' => 'pending',
                'order_date' => now()
            ]);

            $total = 0;

            foreach ($request->products as $index => $product_id) {

                $product = Product::findOrFail($product_id);
                $qty = $request->quantities[$index];

                if ($product->stock < $qty) {
                    throw new \Exception("Stok {$product->name} tidak cukup.");
                }

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

            $order->load('items.product');

            // Buat pesan WA
            $message = "Halo {$customer->name}, berikut pesanan Anda:\n\n";

            foreach ($order->items as $item) {
                $message .= "- {$item->product->name} x{$item->quantity} = Rp "
                            .number_format($item->subtotal,0,',','.')."\n";
            }

            $message .= "\nTotal: Rp ".number_format($order->total_amount,0,',','.');
            $message .= "\nSilakan lakukan pembayaran via QRIS.";

            return redirect("https://wa.me/{$phone}?text=".urlencode($message));
        });
    }
}