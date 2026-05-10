<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; align-items:center; justify-content:space-between;">
            <div>
                <h1>Borrowings</h1>
                <p>Track all book borrowing transactions</p>
            </div>
            <a href="{{ route('borrowings.create') }}" class="btn-primary">+ New Borrowing</a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="card-title">🔄 Borrowing Records</span>
            <span style="font-size:12px; color:#64748b;">{{ $borrowings->count() }} total records</span>
        </div>
        @if($borrowings->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">🔄</div>
                <p>No borrowing records yet.</p>
            </div>
        @else
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Member</th>
                        <th>Book</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowings as $borrowing)
                    <tr>
                        <td style="color:#475569;">{{ $loop->iteration }}</td>
                        <td style="color:#f1f5f9; font-weight:600;">{{ $borrowing->member->name }}</td>
                        <td>{{ $borrowing->book->title }}</td>
                        <td style="color:#64748b; font-size:13px;">{{ $borrowing->borrow_date }}</td>
                        <td style="color:{{ \Carbon\Carbon::parse($borrowing->due_date)->isPast() && $borrowing->status === 'Borrowed' ? '#f87171' : '#64748b' }}; font-size:13px;">
                            {{ $borrowing->due_date }}
                        </td>
                        <td style="color:#64748b; font-size:13px;">{{ $borrowing->return_date ?? '—' }}</td>
                        <td>
                            <span class="badge badge-{{ strtolower($borrowing->status) }}">
                                {{ $borrowing->status }}
                            </span>
                        </td>
                        <td>
                            @if($borrowing->status === 'Borrowed')
                                <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" class="return-form">
                                    @csrf
                                    <input type="date" name="return_date" value="{{ date('Y-m-d') }}" class="return-date-input" required>
                                    <button type="submit" class="btn-success">✔ Return</button>
                                </form>
                            @else
                                <span style="color:#475569; font-size:12px;">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
