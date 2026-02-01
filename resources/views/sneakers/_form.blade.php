<div class="stack">
    <div>
        <label for="brand">Brand</label>
        <input id="brand" name="brand" type="text" value="{{ old('brand', $sneaker->brand ?? '') }}">
        @error('brand')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="model">Model</label>
        <input id="model" name="model" type="text" value="{{ old('model', $sneaker->model ?? '') }}">
        @error('model')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="color">Color</label>
        <input id="color" name="color" type="text" value="{{ old('color', $sneaker->color ?? '') }}">
        @error('color')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="price">Price</label>
        <input id="price" name="price" type="number" step="0.01" value="{{ old('price', $sneaker->price ?? '') }}">
        @error('price')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <label for="image_url">Image URL</label>
        <input id="image_url" name="image_url" type="text" value="{{ old('image_url', $sneaker->image_url ?? '') }}" oninput="updateImagePreview(this.value)">
        @error('image_url')
            <div class="error">{{ $message }}</div>
        @enderror
        <div id="image-preview-container" style="margin-top: 12px; display: none;">
            <label style="font-size: 0.9rem; color: #6b7280;">Preview:</label>
            <img id="image-preview" src="" alt="Preview" style="width: 100%; max-width: 300px; border-radius: 8px; aspect-ratio: 4 / 3; object-fit: cover; border: 1px solid #d1d5db; margin-top: 8px;">
        </div>
    </div>
    <script>
        function updateImagePreview(url) {
            const container = document.getElementById('image-preview-container');
            const preview = document.getElementById('image-preview');
            
            if (url && url.trim() !== '') {
                preview.src = url;
                preview.onerror = function() {
                    container.style.display = 'none';
                };
                preview.onload = function() {
                    container.style.display = 'block';
                };
            } else {
                container.style.display = 'none';
            }
        }
        
        // Show preview on page load if there's already an image URL
        document.addEventListener('DOMContentLoaded', function() {
            const imageUrlInput = document.getElementById('image_url');
            if (imageUrlInput && imageUrlInput.value) {
                updateImagePreview(imageUrlInput.value);
            }
        });
    </script>
    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4">{{ old('description', $sneaker->description ?? '') }}</textarea>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>
</div>

