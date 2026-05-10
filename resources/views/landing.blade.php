<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LibraryMS — Smart Library Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --purple: #6366f1; --violet: #8b5cf6; --dark: #0f1117;
            --card: #1a1d2e; --border: rgba(255,255,255,0.07);
            --text: #e2e8f0; --muted: #64748b;
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background: var(--dark); color: var(--text); overflow-x: hidden; }

        /* NAV */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 60px;
            background: rgba(15,17,23,0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        .nav-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-logo .icon {
            width: 38px; height: 38px; border-radius: 10px;
            background: linear-gradient(135deg, var(--purple), var(--violet));
            display: flex; align-items: center; justify-content: center; font-size: 18px;
        }
        .nav-logo span { font-size: 18px; font-weight: 800; background: linear-gradient(135deg,#a5b4fc,#c4b5fd); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .nav-links { display: flex; align-items: center; gap: 32px; }
        .nav-links a { color: #94a3b8; text-decoration: none; font-size: 14px; font-weight: 500; transition: color .2s; }
        .nav-links a:hover { color: #e2e8f0; }
        .btn-nav {
            padding: 9px 22px; border-radius: 10px;
            background: linear-gradient(135deg, var(--purple), var(--violet));
            color: white; font-weight: 600; font-size: 14px;
            text-decoration: none; transition: all .2s;
            box-shadow: 0 4px 15px rgba(99,102,241,0.35);
        }
        .btn-nav:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(99,102,241,0.5); }

        /* HERO */
        .hero {
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            text-align: center;
            padding: 120px 24px 80px;
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(99,102,241,0.18) 0%, transparent 70%);
        }
        .orb {
            position: absolute; border-radius: 50%;
            filter: blur(90px); opacity: 0.12;
            animation: float 10s ease-in-out infinite;
        }
        .orb1 { width: 500px; height: 500px; background: var(--purple); top: -150px; left: -150px; }
        .orb2 { width: 400px; height: 400px; background: var(--violet); bottom: -100px; right: -100px; animation-delay: -5s; }
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-40px); } }

        .hero-content { position: relative; z-index: 1; max-width: 780px; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 6px 16px; border-radius: 30px;
            background: rgba(99,102,241,0.12);
            border: 1px solid rgba(99,102,241,0.3);
            color: #a5b4fc; font-size: 13px; font-weight: 500;
            margin-bottom: 28px;
        }
        .hero-badge .dot { width: 6px; height: 6px; border-radius: 50%; background: #6366f1; animation: pulse 2s infinite; }
        @keyframes pulse { 0%,100% { opacity:1; } 50% { opacity:.4; } }
        .hero h1 {
            font-size: clamp(42px, 7vw, 72px);
            font-weight: 900; line-height: 1.1;
            letter-spacing: -0.03em;
            margin-bottom: 24px;
        }
        .hero h1 .grad {
            background: linear-gradient(135deg, #a5b4fc 0%, #c4b5fd 50%, #f0abfc 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .hero p {
            font-size: 18px; color: #94a3b8; line-height: 1.7;
            max-width: 560px; margin: 0 auto 40px;
        }
        .hero-btns { display: flex; align-items: center; justify-content: center; gap: 14px; flex-wrap: wrap; }
        .btn-primary {
            padding: 14px 32px; border-radius: 12px;
            background: linear-gradient(135deg, var(--purple), var(--violet));
            color: white; font-weight: 700; font-size: 15px;
            text-decoration: none; transition: all .2s;
            box-shadow: 0 6px 25px rgba(99,102,241,0.4);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(99,102,241,0.55); }
        .btn-ghost {
            padding: 14px 32px; border-radius: 12px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.12);
            color: #e2e8f0; font-weight: 600; font-size: 15px;
            text-decoration: none; transition: all .2s;
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.1); }

        /* STATS BAR */
        .stats-bar {
            display: flex; justify-content: center; gap: 0;
            background: var(--card);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }
        .stat-item {
            flex: 1; max-width: 220px;
            padding: 28px 24px; text-align: center;
            border-right: 1px solid var(--border);
        }
        .stat-item:last-child { border-right: none; }
        .stat-num { font-size: 36px; font-weight: 800; background: linear-gradient(135deg,#a5b4fc,#c4b5fd); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .stat-lbl { font-size: 13px; color: var(--muted); margin-top: 4px; font-weight: 500; }

        /* FEATURES */
        .section { padding: 100px 60px; }
        .section-label {
            display: inline-block; font-size: 12px; font-weight: 700;
            letter-spacing: 0.12em; text-transform: uppercase;
            color: var(--purple); margin-bottom: 14px;
        }
        .section h2 { font-size: clamp(28px,4vw,44px); font-weight: 800; letter-spacing:-0.02em; margin-bottom: 14px; }
        .section .sub { font-size: 17px; color: var(--muted); max-width: 520px; line-height: 1.7; margin-bottom: 56px; }

        .features-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; }
        .feature-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px; padding: 32px;
            transition: all .3s; position: relative; overflow: hidden;
        }
        .feature-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
            background: linear-gradient(90deg, var(--purple), var(--violet));
            opacity: 0; transition: opacity .3s;
        }
        .feature-card:hover { transform: translateY(-4px); border-color: rgba(99,102,241,0.3); box-shadow: 0 20px 50px rgba(0,0,0,0.4); }
        .feature-card:hover::before { opacity: 1; }
        .feature-icon {
            width: 52px; height: 52px; border-radius: 14px;
            background: rgba(99,102,241,0.12);
            border: 1px solid rgba(99,102,241,0.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; margin-bottom: 20px;
        }
        .feature-card h3 { font-size: 17px; font-weight: 700; margin-bottom: 10px; color: #f1f5f9; }
        .feature-card p { font-size: 14px; color: var(--muted); line-height: 1.7; }

        /* HOW IT WORKS */
        .how-section { padding: 100px 60px; background: rgba(26,29,46,0.5); }
        .steps { display: grid; grid-template-columns: repeat(4,1fr); gap: 24px; margin-top: 56px; }
        .step { text-align: center; padding: 0 16px; }
        .step-num {
            width: 56px; height: 56px; border-radius: 50%;
            background: linear-gradient(135deg, var(--purple), var(--violet));
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; font-weight: 800; color: white;
            margin: 0 auto 18px;
            box-shadow: 0 8px 25px rgba(99,102,241,0.4);
        }
        .step h3 { font-size: 16px; font-weight: 700; margin-bottom: 10px; color: #f1f5f9; }
        .step p { font-size: 13px; color: var(--muted); line-height: 1.7; }
        .step-connector { display: flex; align-items: center; padding-top: 28px; }

        /* CTA */
        .cta-section {
            padding: 100px 60px; text-align: center;
            position: relative; overflow: hidden;
        }
        .cta-section::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse 60% 80% at 50% 50%, rgba(99,102,241,0.15) 0%, transparent 70%);
        }
        .cta-box {
            position: relative; max-width: 680px; margin: 0 auto;
            background: var(--card);
            border: 1px solid rgba(99,102,241,0.25);
            border-radius: 28px; padding: 64px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.5);
        }
        .cta-box h2 { font-size: 38px; font-weight: 900; margin-bottom: 16px; letter-spacing: -0.02em; }
        .cta-box p { font-size: 16px; color: var(--muted); margin-bottom: 36px; line-height: 1.7; }

        /* FOOTER */
        footer {
            border-top: 1px solid var(--border);
            padding: 32px 60px;
            display: flex; align-items: center; justify-content: space-between;
        }
        footer .copy { font-size: 13px; color: var(--muted); }
        footer .footer-logo { display: flex; align-items: center; gap: 8px; text-decoration: none; }
        footer .footer-logo span { font-size: 15px; font-weight: 700; background: linear-gradient(135deg,#a5b4fc,#c4b5fd); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav>
    <a href="#" class="nav-logo">
        <div class="icon">📚</div>
        <span>LibraryMS</span>
    </a>
    <div class="nav-links">
        <a href="#features">Features</a>
        <a href="#how">How It Works</a>
        <a href="{{ route('login') }}" class="btn-nav">Sign In →</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>
    <div class="hero-content">
        <div class="hero-badge">
            <span class="dot"></span>
            Modern Library Management System
        </div>
        <h1>
            Manage Your Library<br>
            <span class="grad">Smarter &amp; Faster</span>
        </h1>
        <p>
            A complete solution for managing books, members, borrowing transactions,
            returns, and penalties — all in one centralized, modern dashboard.
        </p>
        <div class="hero-btns">
            <a href="{{ route('login') }}" class="btn-primary">🚀 Get Started</a>
            <a href="#features" class="btn-ghost">Learn More ↓</a>
        </div>
    </div>
</section>

<!-- STATS BAR -->
<div class="stats-bar">
    <div class="stat-item">
        <div class="stat-num">4+</div>
        <div class="stat-lbl">Core Modules</div>
    </div>
    <div class="stat-item">
        <div class="stat-num">100%</div>
        <div class="stat-lbl">Web Based</div>
    </div>
    <div class="stat-item">
        <div class="stat-num">Auto</div>
        <div class="stat-lbl">Penalty Calculation</div>
    </div>
    <div class="stat-item">
        <div class="stat-num">24/7</div>
        <div class="stat-lbl">Always Accessible</div>
    </div>
</div>

<!-- FEATURES -->
<section class="section" id="features">
    <div style="text-align:center;">
        <div class="section-label">✦ Features</div>
        <h2>Everything You Need to Run<br>a Modern Library</h2>
        <p class="sub" style="margin:0 auto 56px;">
            From book cataloging to penalty tracking — LibraryMS covers every aspect of library administration.
        </p>
    </div>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">📖</div>
            <h3>Book Management</h3>
            <p>Add, edit, and delete books with full details including title, author, category, and available copies. Know your inventory at a glance.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">👥</div>
            <h3>Member Directory</h3>
            <p>Maintain a complete register of library members. Store contact information and quickly find members when creating transactions.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🔄</div>
            <h3>Borrowing Transactions</h3>
            <p>Record book loans in seconds. Assign members, select books, set borrow and due dates, and track every borrowing status live.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📅</div>
            <h3>Return Processing</h3>
            <p>Process book returns with a single click. The system automatically updates availability and calculates overdue status.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">⚠️</div>
            <h3>Penalty Management</h3>
            <p>Overdue penalties are computed automatically at ₱10/day. Track payment status and mark fines as paid with ease.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🔐</div>
            <h3>Secure Authentication</h3>
            <p>Admin-only access protected by Laravel's authentication system. Sessions are managed securely to prevent unauthorized access.</p>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="how-section" id="how">
    <div style="text-align:center;">
        <div class="section-label">✦ Workflow</div>
        <h2>How It Works</h2>
        <p class="sub" style="margin:0 auto 0;">
            A simple 4-step process to manage your library operations efficiently.
        </p>
    </div>
    <div class="steps">
        <div class="step">
            <div class="step-num">1</div>
            <h3>Add Books</h3>
            <p>Catalog your books with titles, authors, categories, and copy counts into the system.</p>
        </div>
        <div class="step">
            <div class="step-num">2</div>
            <h3>Register Members</h3>
            <p>Add library members with their name, email, and contact details to the member directory.</p>
        </div>
        <div class="step">
            <div class="step-num">3</div>
            <h3>Record Borrowings</h3>
            <p>Create borrowing transactions by selecting a member, book, borrow date, and due date.</p>
        </div>
        <div class="step">
            <div class="step-num">4</div>
            <h3>Process Returns</h3>
            <p>Log return dates, update statuses, and let the system handle overdue penalty calculations automatically.</p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="cta-box">
        <div style="font-size:48px; margin-bottom:20px;">📚</div>
        <h2>Ready to Manage Your Library?</h2>
        <p>Sign in to your administrator account and start managing books, members, and borrowing transactions in minutes.</p>
        <a href="{{ route('login') }}" class="btn-primary" style="font-size:16px; padding:16px 40px;">
            🚀 Go to Dashboard
        </a>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <a href="#" class="footer-logo">
        <span>📚 LibraryMS</span>
    </a>
    <p class="copy">© {{ date('Y') }} LibraryMS. Library Borrowing Management System.</p>
    <a href="{{ route('login') }}" style="font-size:13px; color:#6366f1; text-decoration:none; font-weight:600;">Sign In →</a>
</footer>

</body>
</html>
