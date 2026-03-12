<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PaymentSetting;
use Barryvdh\DomPDF\Facade\Pdf;



class OrderController extends Controller
{

/* ===============================
   ADMIN
================================ */

public function index()
{
    $orders = Order::with('customer','items.product')->latest()->get();
    return view('orders.index', compact('orders'));
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
   CUSTOMER ORDER
================================ */

public function storePublic(Request $request)
{
    $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'products' => 'required|array',
        'quantities' => 'required|array'
    ]);

    return DB::transaction(function () use ($request){

        $phone = preg_replace('/[^0-9]/','',$request->phone);

        if(substr($phone,0,1) == '0'){
            $phone = '62'.substr($phone,1);
        }

        $customer = Customer::firstOrCreate(
            ['phone'=>$phone],
            [
                'name'=>$request->name,
                'address'=>'-'
            ]
        );

        $order = Order::create([
            'customer_id'=>$customer->id,
            'order_code'=>'ORD'.time(),
            'total_amount'=>0,
            'status'=>'pending',
            'order_date'=>now()
        ]);

        $total = 0;

        foreach ($request->products as $index=>$product_id){

            $product = Product::findOrFail($product_id);
            $qty = $request->quantities[$index];

            if($product->stock < $qty){
                throw new \Exception("Stok {$product->name} tidak cukup");
            }

            $subtotal = $product->price * $qty;

            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$product->id,
                'quantity'=>$qty,
                'price'=>$product->price,
                'subtotal'=>$subtotal
            ]);

            $total += $subtotal;
        }

        $order->update(['total_amount'=>$total]);

        return redirect()->route('order.payment',$order->id);

    });
}


/* ===============================
   PAYMENT PAGE
================================ */

public function paymentPage(Order $order)
{
    $order->load('customer','items.product');

    $setting = PaymentSetting::first();

    return view('frontend.pages.payment',compact('order','setting'));
}


/* ===============================
   WHATSAPP CUSTOMER
================================ */

public function whatsapp(Order $order)
{
    $message = "Halo admin saya sudah melakukan pembayaran.\n";
    $message .= "Order : {$order->order_code}\n";
    $message .= "Total : Rp ".number_format($order->total_amount,0,',','.');

    return redirect(
        "https://wa.me/6285346016066?text=".urlencode($message)
    );
}


/* ===============================
   INVOICE
================================ */

public function invoice(Order $order)
{
    $order->load('customer','items.product');

    $pdf = Pdf::loadView('orders.invoice',compact('order'));

    return $pdf->download('invoice-'.$order->order_code.'.pdf');
}

// =============================== verifikasi pembayaran admin ==============================
public function verify(Order $order)
{
    foreach ($order->items as $item) {

        $product = $item->product;

        $product->stock = max(0, $product->stock - $item->quantity);

        $product->save();
    }

    $order->update([
        'status' => 'paid'
    ]);

    return redirect()
        ->route('orders.index')
        ->with('success','Pesanan berhasil diverifikasi');
}

}