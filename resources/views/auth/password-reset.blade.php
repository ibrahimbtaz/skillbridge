<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url(/umk.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: black;
        }

        .login-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s ease-in-out;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 10px;
            color: darkblue;
            font-weight: 600;
        }

        .login-form p {
            text-align: center;
            margin-bottom: 30px;
            color: #666;
            font-size: 0.9em;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 400;
            color: #555;
            font-size: 0.9em;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1em;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .input-group input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
            outline: none;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background-color: darkblue;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 600;
            margin-top: 10px;
            transition: background-color 0.3s, transform 0.1s;
        }

        .login-button:hover {
            background-color: skyblue;
        }

        .login-button:active {
            transform: scale(0.99);
        }

        .footer-links {
            text-align: center;
            margin-top: 20px;
            font-size: 0.85em;
            color: #888;
        }

        .footer-links a {
            color: #4a90e2;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #357ab8;
            text-decoration: underline;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9em;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 480px) {
            body {
                background-attachment: scroll;
            }

            .login-container {
                padding: 30px 20px;
                max-width: 90%;
                margin: 20px;
                box-shadow: none;
            }

            .login-container:hover {
                transform: none;
            }

            .login-form h2 {
                font-size: 1.4em;
            }

            .login-form p {
                font-size: 0.8em;
                margin-bottom: 20px;
            }

            .input-group input,
            .login-button {
                padding: 10px;
                font-size: 1em;
            }

            .footer-links {
                font-size: 0.75em;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="{{ route('password.update.token') }}" method="POST" autocomplete="off" class="login-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <h2>Reset Password</h2>
            <p>Masukkan password baru Anda.</p>

            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" value="{{ $email }}" readonly>
            </div>

            <div class="input-group">
                <label for="password">Password Baru</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="input-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="login-button">Reset Password</button>

            <div class="footer-links">
                <a href="{{ route('login') }}">Kembali ke Login</a>
            </div>
        </form>
    </div>
</body>
</html>
