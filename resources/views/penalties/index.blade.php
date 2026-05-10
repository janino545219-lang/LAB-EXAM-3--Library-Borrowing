<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; align-items:center; justify-content:space-between;">
            <div>
                <h1>Penalties</h1>
                <p>Manage overdue fines and payment statuses</p>
            </div>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="card-title">⚠️ Penalty Records</span>
            <span style="font-size:12px; color:#64748b;">{{ $penalties->count() }} total penalties</span>
        </div>
        @if($penalties->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">🎉</div>
                <p>No penalties recorded. All members are on time!</p>
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
                        <th>Days Overdue</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penalties as $penalty)
                    <tr>
                        <td style="color:#475569;">{{ $loop->iteration }}</td>
                        <td style="color:#f1f5f9; font-weight:600;">{{ $penalty->borrowing->member->name }}</td>
                        <td>{{ $penalty->borrowing->book->title }}</td>
                        <td style="color:#64748b; font-size:13px;">{{ $penalty->borrowing->borrow_date }}</td>
                        <td style="color:#f87171; font-size:13px;">{{ $penalty->borrowing->due_date }}</td>
                        <td>
                            @php
                                $due = \Carbon\Carbon::parse($penalty->borrowing->due_date);
                                $returned = \Carbon\Carbon::parse($penalty->borrowing->return_date ?? now());
                                $days = $returned->diffInDays($due);
                            @endphp
                            <span style="color:#fb923c; font-weight:600;">{{ $days }} day(s)</span>
                        </td>
                        <td>
                            <span style="color:#f1f5f9; font-weight:700; font-size:15px;">
                                ₱{{ number_format($penalty->amount, 2) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-{{ strtolower($penalty->status) }}">{{ $penalty->status }}</span>
                        </td>
                        <td>
                            @if($penalty->status === 'Unpaid')
                                <form action="{{ route('penalties.pay', $penalty) }}" method="POST" onsubmit="return confirm('Mark penalty as paid?');">
                                    @csrf
                                    <button type="submit" class="btn-success">✔ Mark Paid</button>
                                </form>
                            @else
                                <span style="color:#34d399; font-size:12px;">✔ Settled</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
