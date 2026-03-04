<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();

        $totalPenjualan = Order::count();

        /* ========================
           Revenue bulan ini
        ======================== */

        $revenueMonth = Order::whereMonth('created_at', now()->month)
            ->sum('total_amount');

        /* ========================
           Order hari ini
        ======================== */

        $ordersToday = Order::whereDate('created_at', today())->count();

        /* ========================
           Grafik penjualan harian
        ======================== */

        $dailySales = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_amount) as total')
        )
        ->whereMonth('created_at', now()->month)
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        /* ========================
           Produk terlaris
        ======================== */

        $topProducts = OrderItem::select(
            'product_id',
            DB::raw('SUM(quantity) as total')
        )
        ->with('product')
        ->groupBy('product_id')
        ->orderByDesc('total')
        ->take(5)
        ->get();

        /* ========================
           Low stock
        ======================== */

        $lowStock = Product::where('stock','<=',5)->get();

        return view('dashboard',compact(
            'totalProduk',
            'totalPenjualan',
            'revenueMonth',
            'ordersToday',
            'dailySales',
            'topProducts',
            'lowStock'
        ));
    }
}