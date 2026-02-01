<x-layouts.site title="SneakerApp - My Orders">
    <div class="stack">
        <div class="card">
            <h1>My Orders</h1>
            <p class="muted">Orders you placed while logged in.</p>
        </div>

        @forelse ($orders as $order)
            <div class="card">
                <h3>{{ $order->sneaker->brand }} {{ $order->sneaker->model }}</h3>
                <p class="muted">
                    Qty: {{ $order->quantity }}
                    @if($order->shoe_size)
                        • Size: EUR {{ $order->shoe_size }}
                    @endif
                    • Status: {{ $order->status }}
                </p>
                <strong>${{ number_format($order->total_price, 2) }}</strong>
                <div style="margin-top: 10px;">
                    <form class="inline" method="POST" action="{{ route('orders.destroy', $order) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn danger" type="submit">Cancel</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="card">
                <p class="muted">No orders yet. Go to the sneakers page and place one.</p>
            </div>
        @endforelse

        {{ $orders->links() }}
    </div>
</x-layouts.site>

