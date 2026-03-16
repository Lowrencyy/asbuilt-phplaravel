<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Telcovantage</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background-color: #0a0c10;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 60% at 15% 15%, rgba(0,112,74,0.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 70% at 85% 85%, rgba(30,57,50,0.2) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 50% 50%, rgba(0,112,74,0.05) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            inset: 0;
            /* bg of login */
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            opacity: 0.5;
            z-index: 0;
        }

        /* Orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 0;
            animation: drift 12s ease-in-out infinite alternate;
        }
        .orb-1 {
            width: 400px; height: 400px;
            background: rgba(0,112,74,0.08);
            top: -100px; left: -100px;
        }
        .orb-2 {
            width: 300px; height: 300px;
            background: rgba(30,57,50,0.12);
            bottom: -80px; right: -80px;
            animation-delay: -6s;
        }
        @keyframes drift {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(30px, 20px) scale(1.08); }
        }

        /* Card wrap */
        .card-wrap {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 64rem;
        }

        .login-card {
            overflow: hidden;
            border-radius: 1rem;
            background: #fff;
            box-shadow:
                0 0 0 1px rgba(0,112,74,0.1),
                0 40px 80px rgba(0,0,0,0.5),
                0 0 100px rgba(0,112,74,0.07);
            animation: cardIn 0.55s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        @keyframes cardIn {
            from { opacity: 0; transform: translateY(28px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .card-grid {
            display: grid;
            grid-template-columns: 1fr;
        }

        @media (min-width: 1024px) {
            .card-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* Left: Form panel */
        .form-panel {
            padding: 3rem 2rem;
        }

        @media (min-width: 640px) {
            .form-panel {
                padding: 3rem;
            }
        }

        /* Logo */
        .logo-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .logo-wrap img {
            height: 3rem;
            width: auto;
        }

        /* Headings */
        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: -0.025em;
            color: #0f172a;
            text-align: center;
        }

        .subtitle {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #475569;
            text-align: center;
        }
        .subtitle a {
            font-weight: 500;
            color: #00704A;
            text-decoration: none;
        }
        .subtitle a:hover { color: #006241; }

        /* Form */
        form {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            background: #fff;
            padding: 0.625rem 0.875rem;
            font-size: 0.875rem;
            color: #0f172a;
            font-family: inherit;
            outline: none;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #00704A;
            box-shadow: 0 0 0 4px rgba(0,112,74,0.15);
        }

        /* Remember + Forgot row */
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .remember-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        .remember-label input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            border: 1px solid #cbd5e1;
            accent-color: #00704A;
            cursor: pointer;
        }
        .remember-label span {
            font-size: 0.875rem;
            color: #374151;
        }
        .forgot-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: #00704A;
            text-decoration: none;
        }
        .forgot-link:hover { color: #006241; }

        /* Submit button */
        .btn-submit {
            display: inline-flex;
            width: 100%;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            background: linear-gradient(135deg, #00704A, #1e3932);
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #fff;
            border: none;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: box-shadow 0.2s, filter 0.2s;
        }
        .btn-submit:hover {
            filter: brightness(1.08);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .btn-submit:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(0,112,74,0.25);
        }

        /* Divider */
        .divider {
            position: relative;
            padding-top: 0.5rem;
        }
        .divider-line {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
        }
        .divider-line div {
            width: 100%;
            border-top: 1px solid #e2e8f0;
        }
        .divider-text {
            position: relative;
            display: flex;
            justify-content: center;
        }
        .divider-text span {
            background: #fff;
            padding: 0 1rem;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
        }
        .divider-text span b {
            color: #00704A;
        }

        /* Contact buttons */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            padding-top: 0.5rem;
        }
        .btn-contact {
            display: inline-flex;
            width: 100%;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            text-decoration: none;
            font-family: inherit;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            transition: background 0.15s, box-shadow 0.15s;
        }
        .btn-contact:hover {
            background: #f8fafc;
        }
        .btn-contact:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(100,116,139,0.1);
        }
        .btn-contact svg {
            width: 1.25rem;
            height: 1.25rem;
            flex-shrink: 0;
        }

        /* Right: Image panel */
        .image-panel {
            display: none;
            position: relative;
        }
        @media (min-width: 1024px) {
            .image-panel {
                display: block;
            }
        }
        .image-panel img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(10,12,16,0.6), rgba(30,57,50,0.4), rgba(0,112,74,0.2));
        }
        .image-tagline {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            right: 2rem;
            z-index: 10;
        }
        .image-tagline p {
            color: rgba(255,255,255,0.9);
            font-size: 0.875rem;
            font-weight: 500;
            line-height: 1.6;
            text-shadow: 0 1px 3px rgba(0,0,0,0.4);
        }
        .image-tagline small {
            display: block;
            margin-top: 0.25rem;
            color: rgba(255,255,255,0.5);
            font-size: 0.75rem;
        }
    </style>
</head>

<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="card-wrap">
        <div class="login-card">
            <div class="card-grid">

                <!-- Left: Form -->
                <div class="form-panel">

                    <div class="logo-wrap">
                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="Telcovantage">
                    </div>

                    <h1>Telcovantage Philippines</h1>

                    <p class="subtitle">
                        Your Leading Telecom Partner in
                        <a href="#">Network Optimization and Sustainability</a>
                    </p>

                    <div>
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        @if(config('nativephp-internal.running'))
                        {{-- Native app: login via remote backend API --}}
                        <div id="native-error" style="display:none;color:#dc2626;font-size:0.875rem;margin-bottom:1rem;text-align:center;"></div>
                        <form id="native-login-form">
                        @else
                        <form method="POST" action="{{ route('login') }}">
                        @endif
                            @csrf

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />
                                @error('email')
                                    <span style="color:#dc2626;font-size:0.8rem;margin-top:0.25rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                />
                                @error('password')
                                    <span style="color:#dc2626;font-size:0.8rem;margin-top:0.25rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Remember + Forgot -->
                            <div class="remember-row">
                                <label class="remember-label" for="remember_me">
                                    <input id="remember_me" type="checkbox" name="remember" />
                                    <span>{{ __('Remember me') }}</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a class="forgot-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>

                            <!-- Submit -->
                            <div>
                                <button type="submit" class="btn-submit" id="login-btn">
                                    {{ __('Log in') }}
                                </button>
                            </div>

                            <!-- Divider -->
                            <div class="divider">
                                <div class="divider-line"><div></div></div>
                                <div class="divider-text">
                                    <span>Having trouble? Contact <b>Administrator</b></span>
                                </div>
                            </div>

                            <!-- Contact buttons -->
                            <div class="contact-grid">
                                <a href="mailto:marklaurence.tomenio@telcovantage.com" class="btn-contact">
                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M16.5 6.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z"/>
                                        <path d="M19 12.5c-1.7 0-3 .9-3 2v2.5c0 .6.4 1 1 1h4c.6 0 1-.4 1-1V14.5c0-1.1-1.3-2-3-2Z"/>
                                        <path d="M3 7.5c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v9c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2v-9Zm4 2.2h6v1.6H10.9V16H9.1v-4.7H7V9.7Z"/>
                                    </svg>
                                    Teams
                                </a>

                                <a href="https://wa.me/639910825081" target="_blank" rel="noopener noreferrer" class="btn-contact">
                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2Zm0 18.2a8.2 8.2 0 0 1-4.2-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2Zm4.8-6.1c-.3-.1-1.8-.9-2-.9s-.5-.1-.7.2-.8.9-1 .9-.4 0-.7-.1c-1.8-.9-3-2.6-3.2-3-.2-.3 0-.5.1-.6l.5-.5c.2-.2.2-.4.3-.6 0-.2 0-.4-.1-.6s-.7-1.7-1-2.3c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.6.1-.9.4-.3.3-1.1 1.1-1.1 2.7s1.1 3.2 1.2 3.4c.1.2 2.2 3.4 5.4 4.7.8.3 1.4.5 1.9.6.8.2 1.5.2 2 .1.6-.1 1.8-.7 2-1.4.2-.7.2-1.2.2-1.4 0-.2-.2-.3-.4-.4Z"/>
                                    </svg>
                                    WhatsApp
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Right: Image -->
                <div class="image-panel">
                    <img
                        src="{{ asset('assets/images/about-us.png') }}"
                        alt="Linemen on cherry pickers"
                    />
                    <div class="image-overlay"></div>
                    <div class="image-tagline">
                        <p>"Connecting communities through reliable telecom infrastructure."</p>
                        <small>— Telcovantage Philippines</small>
                    </div>
                </div>

            </div>
        </div>
    </div>


@if(config('nativephp-internal.running'))
<script>
    const NATIVE_API_URL = '{{ env('NATIVE_API_URL', 'http://192.168.1.199:8000') }}';

    document.getElementById('native-login-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const btn = document.getElementById('login-btn');
        const errorBox = document.getElementById('native-error');
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        btn.textContent = 'Logging in...';
        btn.disabled = true;
        errorBox.style.display = 'none';

        try {
            const res = await fetch(NATIVE_API_URL + '/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ email, password }),
            });

            const data = await res.json();

            if (!res.ok) {
                errorBox.textContent = data.message || 'Invalid credentials.';
                errorBox.style.display = 'block';
                btn.textContent = 'Log in';
                btn.disabled = false;
                return;
            }

            // Exchange the Sanctum token for a real web session on the backend
            window.location.href = NATIVE_API_URL + '/native/token-login?token=' + encodeURIComponent(data.token);

        } catch (err) {
            errorBox.textContent = 'Cannot reach server. Make sure you are on the same Wi-Fi as your laptop.';
            errorBox.style.display = 'block';
            btn.textContent = 'Log in';
            btn.disabled = false;
        }
    });
</script>
@endif
</body>
</html>