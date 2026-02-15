<x-layouts.site title="SneakerApp">
    <div class="stack">
        <div class="card">
            <h1>Sneaker World New Collection</h1>
            <p class="muted">The Best Sneakers in the world.</p>
            
            <!-- Search -->
            <form method="GET" action="{{ route('sneakers.index') }}" style="margin-top: 16px;">
                <div style="display: flex; gap: 8px; align-items: end;">
                    <div style="flex: 1;">
                        <label for="search" style="font-weight: 600; display: block; margin-bottom: 6px;">Search</label>
                        <input 
                            id="search" 
                            name="search" 
                            type="text" 
                            placeholder="Search by brand, model, color..." 
                            value="{{ request('search') }}"
                            style="width: 100%;"
                        >
                    </div>
                    <div>
                        <button class="btn" type="submit">Search</button>
                    </div>
                    @if(request('search'))
                        <div>
                            <a class="btn secondary" href="{{ route('sneakers.index') }}">Clear</a>
                        </div>
                    @endif
                </div>
            </form>
            
            @auth
                @if(auth()->user()->is_admin)
                    <div style="margin-top: 16px;">
                        <a class="btn" href="{{ route('sneakers.create') }}">Add Sneaker</a>
                    </div>
                @endif
            @endauth
        </div>

        <div class="grid">
            @foreach ($sneakers as $sneaker)
                <div class="card">
                    <img class="sneaker" src="{{ $sneaker->image_url }}" alt="{{ $sneaker->brand }} {{ $sneaker->model }}">
                    <h3>{{ $sneaker->brand }} {{ $sneaker->model }}</h3>
                    <p class="muted">{{ $sneaker->color ?? 'Classic color' }}</p>
                    
                    @auth
                        @if(auth()->user()->is_admin)
                            <form class="inline-price-form" method="POST" action="{{ route('sneakers.updatePrice', $sneaker) }}" style="display: flex; gap: 8px; align-items: center; margin: 8px 0;">
                                @csrf
                                @method('PATCH')
                                <label for="price-{{ $sneaker->id }}" style="font-weight: 600; margin: 0;">$</label>
                                <input id="price-{{ $sneaker->id }}" name="price" type="number" step="0.01" value="{{ $sneaker->price }}" style="width: 80px; padding: 4px 8px; margin: 0;">
                                <button class="btn" type="submit" style="padding: 4px 8px; font-size: 0.85rem;">Update</button>
                            </form>
                        @else
                            <strong>${{ number_format($sneaker->price, 2) }}</strong>
                        @endif
                    @else
                        <strong>${{ number_format($sneaker->price, 2) }}</strong>
                    @endauth
                    
                    <div class="stack" style="margin-top: 10px;">
                        <a class="btn secondary" href="{{ route('sneakers.show', $sneaker) }}">View details</a>
                        @auth
                            @if(auth()->user()->is_admin)
                                <a class="btn secondary" href="{{ route('sneakers.edit', $sneaker) }}">Edit</a>
                                <button 
                                    class="btn danger" 
                                    type="button" 
                                    onclick="confirmDelete({{ $sneaker->id }}, '{{ $sneaker->brand }} {{ $sneaker->model }}')"
                                >
                                    Delete
                                </button>
                                <form id="delete-form-{{ $sneaker->id }}" method="POST" action="{{ route('sneakers.destroy', $sneaker) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Improved Pagination -->
        @if($sneakers->hasPages())
            <div class="card" style="text-align: center;">
                <div style="display: flex; justify-content: center; align-items: center; gap: 12px; flex-wrap: wrap;">
                    @if($sneakers->onFirstPage())
                        <span style="padding: 8px 12px; color: #9ca3af; cursor: not-allowed;">Previous</span>
                    @else
                        <a href="{{ $sneakers->previousPageUrl() }}" class="btn secondary">Previous</a>
                    @endif
                    
                    <span style="padding: 8px 12px;">
                        Page {{ $sneakers->currentPage() }} of {{ $sneakers->lastPage() }}
                        <span class="muted">({{ $sneakers->total() }} total)</span>
                    </span>
                    
                    @if($sneakers->hasMorePages())
                        <a href="{{ $sneakers->nextPageUrl() }}" class="btn secondary">Next</a>
                    @else
                        <span style="padding: 8px 12px; color:rgb(158, 173, 200); cursor: not-allowed;">Next</span>
                    @endif
                </div>
            </div>
        @endif
        
        @if($sneakers->isEmpty())
            <div class="card" style="text-align: center; padding: 40px;">
                <h2 style="color: #6b7280; margin-bottom: 12px;">No sneakers found</h2>
                <p class="muted">Try adjusting your search.</p>
            </div>
        @endif
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div class="card" style="max-width: 400px; margin: 20px;">
            <h2 style="margin-bottom: 12px;">Confirm Delete</h2>
            <p>Are you sure you want to delete <strong id="delete-sneaker-name"></strong>?</p>
            <p class="muted" style="font-size: 0.9rem; margin-top: 8px;">This action cannot be undone.</p>
            <div style="display: flex; gap: 8px; margin-top: 20px;">
                <button class="btn danger" id="confirm-delete-btn" style="flex: 1;">Yes, Delete</button>
                <button class="btn secondary" onclick="closeDeleteModal()" style="flex: 1;">Cancel</button>
            </div>
        </div>
    </div>
    
    <script>
        let deleteFormId = null;
        
        function confirmDelete(sneakerId, sneakerName) {
            deleteFormId = 'delete-form-' + sneakerId;
            document.getElementById('delete-sneaker-name').textContent = sneakerName;
            document.getElementById('delete-modal').style.display = 'flex';
        }
        
        function closeDeleteModal() {
            document.getElementById('delete-modal').style.display = 'none';
            deleteFormId = null;
        }
        
        document.getElementById('confirm-delete-btn').addEventListener('click', function() {
            if (deleteFormId) {
                document.getElementById(deleteFormId).submit();
            }
        });
        
        // Close modal when clicking outside
        document.getElementById('delete-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</x-layouts.site>

