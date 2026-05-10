<x-app-layout>
    <x-slot name="header">
        <div style="display:flex; align-items:center; gap:12px;">
            <a href="{{ route('members.index') }}" class="btn-secondary" style="padding:6px 12px; font-size:12px;">← Back</a>
            <div>
                <h1>Add New Member</h1>
                <p>Register a new library member</p>
            </div>
        </div>
    </x-slot>

    <div style="max-width:600px; margin:0 auto;">
        <div class="card">
            <div class="card-header"><span class="card-title">👤 Member Details</span></div>
            <div class="card-body">
                <form method="POST" action="{{ route('members.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="e.g. Juan dela Cruz" required>
                        @error('name') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="e.g. juan@email.com" required>
                        @error('email') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number <span style="color:#475569; font-weight:400;">(optional)</span></label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="e.g. 09XX-XXX-XXXX">
                        @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div style="display:flex; gap:10px; margin-top:8px;">
                        <button type="submit" class="btn-primary">💾 Save Member</button>
                        <a href="{{ route('members.index') }}" class="btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
