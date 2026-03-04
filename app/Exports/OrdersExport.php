<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    public function collection()
    {
        return Order::select(
            'order_code',
            'total_amount',
            'created_at'
        )->get();
    }
}