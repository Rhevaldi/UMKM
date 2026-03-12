<h2>INVOICE PENJUALAN</h2>

<hr>

<p>
    <b>Kode Order :</b> {{ $order->order_code }} <br>
    <b>Customer :</b> {{ $order->customer->name }} <br>
    <b>Tanggal :</b> {{ $order->created_at->format('d M Y') }}
</p>

<table width="100%" border="1" cellspacing="0" cellpadding="6">

    <tr>
        <th>Produk</th>
        <th>Qty</th>
        <th>Harga</th>
        <th>Subtotal</th>
    </tr>

    @foreach ($order->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price) }}</td>
            <td>{{ number_format($item->subtotal) }}</td>
        </tr>
    @endforeach

</table>

<h3 style="text-align:right">

    Total :
    Rp {{ number_format($order->total_amount) }}

</h3>
