<x-layouts.site title="SneakerApp - Edit Sneaker">
    <div class="stack">
        <div class="card">
            <a class="btn secondary" href="{{ route('sneakers.index') }}">Back to list</a>
        </div>
        <div class="card">
            <h1>Edit Sneaker</h1>
            <form class="stack" method="POST" action="{{ route('sneakers.update', $sneaker) }}">
                @csrf
                @method('PUT')
                @include('sneakers._form', ['sneaker' => $sneaker])
                <button class="btn" type="submit">Update</button>
            </form>
        </div>
    </div>
</x-layouts.site>

