<x-guest-layout>
    <h2>Welcome back</h2>
    <p class="subtitle">Sign in to your administrator account</p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="status-msg">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input id="email" type="email" name="email" class="form-input"
                   value="{{ old('email') }}" placeholder="admin@example.com" required autofocus autocomplete="username">
            @error('email')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input id="password" type="password" name="password" class="form-input"
                   placeholder="••••••••" required autocomplete="current-password">
            @error('password')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="remember" id="remember_me">
                Keep me signed in
            </label>
        </div>

        <div class="form-footer">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
            @else
                <span></span>
            @endif
            <button type="submit" class="btn-login">Sign In →</button>
        </div>
    </form>
</x-guest-layout>
