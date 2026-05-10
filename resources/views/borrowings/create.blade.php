<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; align-items:center; gap:12px;">
            <a href="{{ route('borrowings.index') }}" class="btn-secondary" style="padding:6px 12px; font-size:12px;">← Back</a>
            <div>
                <h1>New Borrowing</h1>
                <p>Create a new book borrowing transaction</p>
            </div>
        </div>
    </x-slot>

    <div style="max-width:640px; margin:0 auto;">
        <div class="card">
            <div class="card-header"><span class="card-title">🔄 Borrowing Details</span></div>
            <div class="card-body">
                <form method="POST" action="{{ route('borrowings.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Select Member</label>
                        <select name="member_id" class="form-input" required>
                            <option value="">— Choose a member —</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} — {{ $member->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('member_id') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select Book</label>
                        <select name="book_id" class="form-input" required>
                            <option value="">— Choose a book —</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }} ({{ $book->copies_available }} available)
                                </option>
                            @endforeach
                        </select>
                        @error('book_id') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div class="form-group">
                            <label class="form-label">Borrow Date</label>
                            <input type="date" name="borrow_date" value="{{ old('borrow_date', date('Y-m-d')) }}" class="form-input" required>
                            @error('borrow_date') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Due Date</label>
                            <input type="date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}" class="form-input" required>
                            @error('due_date') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div style="display:flex; gap:10px; margin-top:8px;">
                        <button type="submit" class="btn-primary">💾 Create Borrowing</button>
                        <a href="{{ route('borrowings.index') }}" class="btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
