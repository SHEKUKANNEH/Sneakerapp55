<x-layouts.site title="SneakerApp - Add Sneaker">
    <div class="card">
        <h1>Add a Sneaker</h1>
        <form class="stack" method="POST" action="{{ route('sneakers.store') }}">
            @csrf
            @include('sneakers._form')
            <button class="btn" type="submit">Save</button>
        </form>
    </div>
</x-layouts.site>

