<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; align-items:center; justify-content:space-between;">
            <div>
                <h1>Members</h1>
                <p>Manage library members and their accounts</p>
            </div>
            <a href="{{ route('members.create') }}" class="btn-primary">+ Add Member</a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="card-title">👥 Member Directory</span>
            <span style="font-size:12px; color:#64748b;">{{ $members->count() }} members registered</span>
        </div>
        @if($members->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">👤</div>
                <p>No members yet. Add your first member!</p>
            </div>
        @else
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr>
                        <td style="color:#475569;">{{ $loop->iteration }}</td>
                        <td>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#6366f1,#8b5cf6); display:flex; align-items:center; justify-content:center; font-weight:700; font-size:13px; color:white; flex-shrink:0;">
                                    {{ strtoupper(substr($member->name,0,1)) }}
                                </div>
                                <span style="color:#f1f5f9; font-weight:600;">{{ $member->name }}</span>
                            </div>
                        </td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->phone ?? '—' }}</td>
                        <td style="color:#64748b; font-size:12px;">{{ $member->created_at->format('M d, Y') }}</td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <a href="{{ route('members.edit', $member) }}" class="btn-edit">✏️ Edit</a>
                                <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Delete this member?');">
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
