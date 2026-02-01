<x-layouts.site title="SneakerApp - {{ $sneaker->brand }} {{ $sneaker->model }}">
    <div class="stack">
        <div class="card">
            <a class="btn secondary" href="{{ route('sneakers.index') }}">Back to list</a>
        </div>

        <div class="card">
            <img class="sneaker" src="{{ $sneaker->image_url }}" alt="{{ $sneaker->brand }} {{ $sneaker->model }}">
            <h1>{{ $sneaker->brand }} {{ $sneaker->model }}</h1>
            <p class="muted">{{ $sneaker->color ?? 'Classic color' }}</p>
            <p>{{ $sneaker->description ?? 'Simple, clean sneaker for everyday wear.' }}</p>
            <strong>${{ number_format($sneaker->price, 2) }}</strong>

            <div class="stack" style="margin-top: 14px;">
                @auth
                    @if(auth()->user()->is_admin)
                        <a class="btn secondary" href="{{ route('sneakers.edit', $sneaker) }}">Edit Sneaker</a>
                        <form class="inline" method="POST" action="{{ route('sneakers.destroy', $sneaker) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn danger" type="submit">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>

        <div class="card">
            <h2>Place an Order</h2>
            @auth
                <form class="stack" method="POST" action="{{ route('orders.store', $sneaker) }}">
                    @csrf
                    <div>
                        <label for="quantity">Quantity</label>
                        <input id="quantity" name="quantity" type="number" min="1" max="10" value="1">
                        @error('quantity')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn" type="submit">Order Now</button>
                </form>
            @else
                <p class="muted">Please <a href="{{ route('login') }}">log in</a> to place an order.</p>
            @endauth
        </div>
    </div>
</x-layouts.site>

