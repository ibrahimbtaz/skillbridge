<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <!-- Jika ada file style.css di proyek, tetap gunakan -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Minimal fallback styling in case style.css is missing */
        body { font-family: Arial, sans-serif; background:#f2f2f2; margin:0; padding:0; }
        .login-container { display:flex; align-items:center; justify-content:center; height:100vh; }
        .login-form { background:#fff; padding:24px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); width:320px; }
        .login-form h2 { margin:0 0 8px; }
        .input-group { margin-bottom:12px; }
        label { display:block; margin-bottom:6px; font-size:14px; }
        input[type="text"], input[type="email"], input[type="password"] { width:100%; padding:8px 10px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box; }
        .login-button { width:100%; padding:10px; background:#007bff; color:#fff; border:none; border-radius:4px; cursor:pointer; font-size:16px; }
        .login-button:disabled { background:#8fb6ff; cursor:not-allowed; }
        .footer-links { margin-top:12px; font-size:14px; text-align:center; }
        .message { margin:8px 0; text-align:center; }
        .message.error { color:#b00020; }
        .message.success { color:#006400; }
    </style>
</head>
<body>

    <div class="login-container">
        <form class="login-form" id="registerForm" action="proses_registrasi.php" method="POST" novalidate>
            <h2>Daftar Akun Baru</h2>
            <p>Isi data Anda untuk membuat akun.</p>

            <div id="pesan" class="message" aria-live="polite"></div>

            <div class="input-group">
                <label for="username">Nama Pengguna</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required minlength="6">
            </div>

            <div class="input-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required minlength="6">
            </div>

            <button type="submit" id="submitBtn" name="register_submit" class="login-button">Daftar</button>

            <div class="footer-links">
                Sudah punya akun?
                <a href="login.php">Masuk di sini</a>
            </div>
        </form>
    </div>

    <script>
        // Ambil parameter status dari query string (digunakan di register.php via PHP sebelumnya)
        (function () {
            function getQueryParam(name) {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(name);
            }

            const pesanEl = document.getElementById('pesan');
            const status = getQueryParam('status');
            if (status === 'gagal_password') {
                pesanEl.textContent = 'Password dan Konfirmasi Password tidak cocok!';
                pesanEl.classList.add('error');
            } else if (status === 'gagal_duplikat') {
                pesanEl.textContent = 'Username atau Email sudah terdaftar!';
                pesanEl.classList.add('error');
            }
        })();

        // Simple client-side validation: ensure passwords match before submitting
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            const pass = document.getElementById('password').value;
            const conf = document.getElementById('confirm_password').value;
            const pesanEl = document.getElementById('pesan');

            // Clear previous message
            pesanEl.textContent = '';
            pesanEl.className = 'message';

            if (pass !== conf) {
                e.preventDefault();
                pesanEl.textContent = 'Password dan Konfirmasi Password tidak cocok!';
                pesanEl.classList.add('error');
                return false;
            }

            // Optionally disable button to prevent double submit
            document.getElementById('submitBtn').disabled = true;
            return true;
        });
    </script>

</body>
</html>
