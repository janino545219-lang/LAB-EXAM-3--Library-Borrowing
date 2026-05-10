<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; align-items:center; gap:12px;">
            <a href="{{ route('books.index') }}" class="btn-secondary" style="padding:6px 12px; font-size:12px;">← Back</a>
            <div>
                <h1>Edit Book</h1>
                <p>Update the details for "{{ $book->title }}"</p>
            </div>
        </div>
    </x-slot>

    <div style="max-width:600px; margin:0 auto;">
        <div class="card">
            <div class="card-header"><span class="card-title">✏️ Edit Book Details</span></div>
            <div class="card-body">
                <form method="POST" action="{{ route('books.update', $book) }}">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Book Title</label>
                        <input type="text" name="title" value="{{ old('title', $book->title) }}" class="form-input" required>
                        @error('title') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" value="{{ old('author', $book->author) }}" class="form-input" required>
                        @error('author') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" value="{{ old('category', $book->category) }}" class="form-input" required>
                        @error('category') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Copies Available</label>
                        <input type="number" name="copies_available" value="{{ old('copies_available', $book->copies_available) }}" class="form-input" min="0" required>
                        @error('copies_available') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div style="display:flex; gap:10px; margin-top:8px;">
                        <button type="submit" class="btn-primary">💾 Update Book</button>
                        <a href="{{ route('books.index') }}" class="btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
