<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; align-items:center; justify-content:space-between;">
            <div>
                <h1>Books</h1>
                <p>Manage your library's book collection</p>
            </div>
            <a href="{{ route('books.create') }}" class="btn-primary">+ Add Book</a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="card-title">📖 Book Collection</span>
            <span style="font-size:12px; color:#64748b;">{{ $books->count() }} books total</span>
        </div>
        @if($books->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">📚</div>
                <p>No books yet. Add your first book!</p>
            </div>
        @else
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Copies Available</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td style="color:#475569;">{{ $loop->iteration }}</td>
                        <td style="color:#f1f5f9; font-weight:600;">{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            <span style="display:inline-flex; align-items:center; padding:2px 10px; background:rgba(99,102,241,0.1); border:1px solid rgba(99,102,241,0.2); border-radius:20px; font-size:11px; color:#a5b4fc;">
                                {{ $book->category }}
                            </span>
                        </td>
                        <td>
                            <span style="font-weight:700; color:{{ $book->copies_available > 0 ? '#34d399' : '#f87171' }};">
                                {{ $book->copies_available }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <a href="{{ route('books.edit', $book) }}" class="btn-edit">✏️ Edit</a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Delete this book?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger">🗑 Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
