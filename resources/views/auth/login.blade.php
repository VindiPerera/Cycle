<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login – CycleCare</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 50%, #90caf9 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
        }

        .logo {
            text-align: center;
            margin-bottom: 8px;
        }

        .logo svg {
            width: 52px;
            height: 52px;
        }

        h1 {
            text-align: center;
            font-size: 1.75rem;
            font-weight: 700;
            color: #1565c0;
            margin-bottom: 6px;
        }

        .subtitle {
            text-align: center;
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 6px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #333;
            transition: border-color 0.2s;
            outline: none;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #1976d2;
            box-shadow: 0 0 0 3px rgba(25,118,210,0.15);
        }

        .error-text {
            color: #e53935;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 28px;
        }

        .remember-row input[type="checkbox"] {
            accent-color: #1976d2;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .remember-row label {
            margin: 0;
            font-weight: 400;
            color: #555;
            cursor: pointer;
        }

        button[type="submit"] {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #1976d2, #1565c0);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.3px;
            transition: opacity 0.2s, transform 0.1s;
        }

        button[type="submit"]:hover {
            opacity: 0.92;
            transform: translateY(-1px);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .alert-error {
            background: #fdecea;
            border: 1px solid #f5c6cb;
            color: #c62828;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 0.875rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            <!-- Cycle / heart icon -->
            <svg viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="26" cy="26" r="26" fill="#e3f2fd"/>
                <path d="M26 37s-10-6.5-10-13a6 6 0 0 1 10-4.47A6 6 0 0 1 36 24c0 6.5-10 13-10 13z" fill="#1976d2"/>
            </svg>
        </div>

        <h1>CycleCare</h1>
        <p class="subtitle">Sign in to your account</p>

        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    autofocus
                    placeholder="you@example.com"
                >
                @error('email')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>
