<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login Keren</title>
    <style>
        /* Pengaturan dasar untuk body dan background */
body {
    font-family: 'Poppins', sans-serif;
    background-image: url(umk.png);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
    background-attachment: scroll;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    color: black;
}

/* Container utama untuk form */
.login-container {
    background: #ffffff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;
    transition: transform 0.3s ease-in-out;
}

/* Efek hover pada container */
.login-container:hover {
    transform: translateY(-5px);
}

/* Style tulisan untuk judul dan paragraf */
.login-form h2 {
    text-align: center;
    margin-bottom: 10px;
    color: darkblue; /* Untuk Warna judul */
    font-weight: 600;
}

.login-form p {
    text-align: center;
    margin-bottom: 30px;
    color: #666;
    font-size: 0.9em;
}

/* Styling grup input */
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

/* Efek fokus pada input */
.input-group input:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
    outline: none; /* Menghilangkan outline default browser */
}

/* Styling tombol login */
.login-button {
    width: 100%;
    padding: 12px;
    background-color: darkblue; /* Untuk Warna utama tombol */
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1.1em;
    font-weight: 600;
    margin-top: 10px;
    transition: background-color 0.3s, transform 0.1s;
}

/* Efek hover dan active pada tombol */
.login-button:hover {
    background-color: skyblue; /* Warna saat di-hover */
}

.login-button:active {
    transform: scale(0.99); /* Efek klik tombol */
}

/* Styling link footer */
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

.footer-links span {
    margin: 0 10px;
}

/* --- Media Query untuk Layar Kecil (Max Width: 480px) --- */
@media (max-width: 480px) {

    /* Penyesuaian Body */
    body {
        /* Untuk Memastikan latar belakang tetap bagus di ponsel jika gambar besar */
        background-attachment: scroll;
    }

    /* Penyesuaian Container Utama Form */
    .login-container {
        /* Mengurangi padding agar form lebih ringkas */
        padding: 30px 20px;
        /* Memastikan form menggunakan hampir seluruh lebar layar */
        max-width: 90%;
        /* Memberi sedikit jarak dari tepi layar ponsel */
        margin: 20px;
        /* Menghilangkan efek bayangan yang mungkin berlebihan di layar kecil */
        box-shadow: none;
    }

    /* Menghilangkan efek hover pada container di layar sentuh */
    .login-container:hover {
        transform: none;
    }

    /* Penyesuaian Ukuran Font */
    .login-form h2 {
        font-size: 1.4em;
    }

    .login-form p {
        font-size: 0.8em;
        margin-bottom: 20px;
    }

    /* Penyesuaian Utuk Input dan Tombol */
    .input-group input,
    .login-button {
        padding: 10px;
        font-size: 1em;
    }

    /* Penyesuaian Link Footer */
    .footer-links {
        font-size: 0.75em;
    }
}
    </style>
</head>
<body>
    <div class="login-container">
        <form action="{{ route('login') }}" method="POST" autocomplete="off" class="login-form">
            @csrf
            <h2>Hallo Selamat Datang</h2>
            <p>Silahkan Login ke akun Anda.</p>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="login-button">Masuk</button>

            <div class="footer-links">
                <a href="#">Lupa Password?</a>
                <span>|</span>
                <a href="#">Daftar Akun Baru</a>
            </div>
        </form>
    </div>

</body>
</html>
