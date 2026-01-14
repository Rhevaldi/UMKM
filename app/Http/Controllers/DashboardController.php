<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah total data dari tabel products
        $totalProduk = Product::count();

        // Menghitung total penjualan
        $totalPenjualan = Order::count(); 



        // Kirim data ke view dashboard
        return view('dashboard', compact('totalProduk', 'totalPenjualan'));
    }
}
