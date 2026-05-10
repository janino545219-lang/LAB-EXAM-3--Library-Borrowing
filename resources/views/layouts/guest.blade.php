<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>LibraryMS — Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
            body {
                background: #0f1117;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow: hidden;
            }
            /* Animated background orbs */
            .bg-orb {
                position: absolute; border-radius: 50%;
                filter: blur(80px); opacity: 0.15;
                animation: float 8s ease-in-out infinite;
            }
            .orb-1 { width: 400px; height: 400px; background: #6366f1; top: -100px; left: -100px; }
            .orb-2 { width: 300px; height: 300px; background: #8b5cf6; bottom: -50px; right: 100px; animation-delay: -4s; }
            .orb-3 { width: 200px; height: 200px; background: #06b6d4; top: 50%; left: 60%; animation-delay: -2s; }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-30px); }
            }

            .login-container {
                position: relative; z-index: 10;
                width: 100%; max-width: 440px;
                padding: 0 20px;
            }
            .login-logo {
                text-align: center; margin-bottom: 32px;
            }
            .logo-icon-wrap {
                width: 64px; height: 64px; border-radius: 20px;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                display: flex; align-items: center; justify-content: center;
                font-size: 30px; margin: 0 auto 14px;
                box-shadow: 0 8px 30px rgba(99,102,241,0.4);
            }
            .login-logo h1 {
                font-size: 26px; font-weight: 800;
                background: linear-gradient(135deg, #a5b4fc, #c4b5fd);
                -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            }
            .login-logo p {
                font-size: 13px; color: #64748b; margin-top: 4px;
            }

            .login-card {
                background: #1a1d2e;
                border: 1px solid rgba(255,255,255,0.08);
                border-radius: 20px;
                padding: 36px;
                box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            }
            .login-card h2 {
                font-size: 18px; font-weight: 700; color: #f1f5f9;
                margin-bottom: 6px;
            }
            .login-card .subtitle {
                font-size: 13px; color: #64748b; margin-bottom: 28px;
            }

            .form-group { margin-bottom: 18px; }
            .form-label {
                display: block; font-size: 12px; font-weight: 600;
                color: #94a3b8; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;
            }
            .form-input {
                width: 100%; padding: 12px 16px;
                background: rgba(255,255,255,0.05);
                border: 1px solid rgba(255,255,255,0.1);
                border-radius: 12px; color: #e2e8f0; font-size: 14px;
                transition: all 0.2s; outline: none;
            }
            .form-input:focus {
                border-color: #6366f1;
                box-shadow: 0 0 0 3px rgba(99,102,241,0.2);
                background: rgba(99,102,241,0.08);
            }
            .form-input::placeholder { color: #475569; }

            .checkbox-label {
                display: flex; align-items: center; gap: 8px;
                font-size: 13px; color: #94a3b8; cursor: pointer;
            }
            .checkbox-label input[type="checkbox"] {
                width: 16px; height: 16px; accent-color: #6366f1;
            }

            .form-footer {
                display: flex; align-items: center; justify-content: space-between;
                margin-top: 24px;
            }
            .forgot-link {
                font-size: 13px; color: #6366f1; text-decoration: none;
                transition: color 0.2s;
            }
            .forgot-link:hover { color: #818cf8; }

            .btn-login {
                padding: 12px 28px;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                color: white; border: none; border-radius: 12px;
                font-size: 14px; font-weight: 700; cursor: pointer;
                transition: all 0.2s;
                box-shadow: 0 4px 20px rgba(99,102,241,0.4);
                letter-spacing: 0.02em;
            }
            .btn-login:hover {
                transform: translateY(-1px);
                box-shadow: 0 8px 25px rgba(99,102,241,0.5);
            }

            .error-msg {
                background: rgba(239,68,68,0.1);
                border: 1px solid rgba(239,68,68,0.2);
                color: #f87171; border-radius: 8px;
                padding: 10px 14px; font-size: 13px;
                margin-top: 6px;
            }
            .status-msg {
                background: rgba(16,185,129,0.1);
                border: 1px solid rgba(16,185,129,0.2);
                color: #34d399; border-radius: 8px;
                padding: 10px 14px; font-size: 13px;
                margin-bottom: 18px;
            }
        </style>
    </head>
    <body>
        <!-- Background orbs -->
        <div class="bg-orb orb-1"></div>
        <div class="bg-orb orb-2"></div>
        <div class="bg-orb orb-3"></div>

        <div class="login-container">
            <div class="login-logo">
                <div class="logo-icon-wrap">📚</div>
                <h1>LibraryMS</h1>
                <p>Library Management System</p>
            </div>
            <div class="login-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
