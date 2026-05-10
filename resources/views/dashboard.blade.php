<x-app-layout>
    <x-slot name="header">
        <h1>Dashboard</h1>
        <p>Welcome back, {{ Auth::user()->name }}! Here's what's happening in the library today.</p>
    </x-slot>

    <!-- Stats Grid -->
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom:28px;">
        <div class="stat-card purple">
            <div class="stat-icon purple">📖</div>
            <div class="stat-number">{{ $totalBooks }}</div>
            <div class="stat-label">Books Available</div>
        </div>
        <div class="stat-card blue">
            <div class="stat-icon blue">👥</div>
            <div class="stat-number">{{ $totalMembers }}</div>
            <div class="stat-label">Total Members</div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon green">🔄</div>
            <div class="stat-number">{{ $activeBorrowings }}</div>
            <div class="stat-label">Active Borrowings</div>
        </div>
        <div class="stat-card red">
            <div class="stat-icon red">⚠️</div>
            <div class="stat-number">{{ $unpaidPenalties }}</div>
            <div class="stat-label">Unpaid Penalties</div>
        </div>
    </div>

    <!-- Recent Borrowings -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">Recent Borrowings</span>
            <a href="{{ route('borrowings.index') }}" class="btn-secondary" style="font-size:12px; padding:6px 14px;">View All →</a>
        </div>
        @if ($recentBorrowings->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <p>No borrowing records yet.</p>
            </div>
        @else
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Book</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBorrowings as $b)
                    <tr>
                        <td style="color:#f1f5f9; font-weight:500;">{{ $b->member->name }}</td>
                        <td>{{ $b->book->title }}</td>
                        <td>{{ $b->borrow_date }}</td>
                        <td>{{ $b->due_date }}</td>
                        <td>
                            <span class="badge badge-{{ strtolower($b->status) }}">{{ $b->status }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Quick Actions -->
    <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:20px; margin-top:24px;">
        <div class="card">
            <div class="card-header"><span class="card-title">Quick Actions</span></div>
            <div class="card-body" style="display:flex; flex-direction:column; gap:10px;">
                <a href="{{ route('books.create') }}" class="btn-primary" style="justify-content:center;">📖 Add New Book</a>
                <a href="{{ route('members.create') }}" class="btn-secondary" style="justify-content:center;">👥 Add New Member</a>
                <a href="{{ route('borrowings.create') }}" class="btn-secondary" style="justify-content:center;">🔄 New Borrowing</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><span class="card-title">Penalty Summary</span></div>
            <div class="card-body">
                <div style="display:flex; align-items:center; justify-content:space-between; padding: 12px 0; border-bottom:1px solid rgba(255,255,255,0.05);">
                    <span style="color:#94a3b8; font-size:13px;">Unpaid Penalties</span>
                    <span class="badge badge-unpaid">{{ $unpaidPenalties }}</span>
                </div>
                <div style="padding-top:16px;">
                    <a href="{{ route('penalties.index') }}" class="btn-danger" style="width:100%; justify-content:center;">⚠️ View All Penalties</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
