<h2>Invoice {{ $order->order_code }}</h2>

<p>Customer: {{ $order->customer->name }}</p>
<p>Tanggal: {{ $order->order_date }}</p>

<table width="100%" border="1" cellspacing="0">
<tr>
<th>Produk</th>
<th>Qty</th>
<th>Harga</th>
<th>Subtotal</th>
</tr>

@foreach($order->items as $item)
<tr>
<td>{{ $item->product->name }}</td>
<td>{{ $item->quantity }}</td>
<td>{{ number_format($item->price) }}</td>
<td>{{ number_format($item->subtotal) }}</td>
</tr>
@endforeach
</table>

<h3>Total: Rp {{ number_format($order->total_amount) }}</h3>