<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date ?? now()->toDateString();

        $orders = Order::with('customer')
            ->whereDate('created_at',$date)
            ->get();

        $total = $orders->sum('total_amount');

        /* ======================
           Revenue per bulan
        ====================== */

        $monthlyRevenue = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total','month');

        /* ======================
           Produk terlaris
        ====================== */

        $topProducts = OrderItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total')
            )
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('reports.index', compact(
            'orders',
            'total',
            'date',
            'monthlyRevenue',
            'topProducts'
        ));
    }
}