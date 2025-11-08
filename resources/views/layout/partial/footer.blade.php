<style>
    /* Footer */
    .footer {
        background-color: #222;
        color: white;
        text-align: center;
        padding: 40px 30px;
        margin-top: 50px;
        border-top: 3px solid darkblue;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        text-align: left;
        margin-bottom: 30px;
    }

    .footer-section h4 {
        color: #87ceeb;
        margin-bottom: 15px;
        font-size: 1.1em;
    }

    .footer-section ul {
        list-style: none;
    }

    .footer-section ul li {
        margin-bottom: 10px;
    }

    .footer-section a {
        color: #ccc;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-section a:hover {
        color: #87ceeb;
    }

    .footer-bottom {
        border-top: 1px solid #444;
        padding-top: 20px;
        text-align: center;
        color: #999;
    }

    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .footer-section a,
        .footer-section ul li {
            text-align: center;
        }
    }
</style>

<!-- Footer -->
<div class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h4>Tentang Kami</h4>
            <p>Skillbridge adalah platform pembelajaran online terpercaya dengan ribuan kursus berkualitas.</p>
        </div>

        <div class="footer-section">
            <h4>Navigasi</h4>
            <ul>
                <li><a href="/home">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#services">Layanan</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Kategori Kursus</h4>
            <ul>
                <li><a href="#">Pemrograman</a></li>
                <li><a href="#">Desain</a></li>
                <li><a href="#">Bisnis</a></li>
                <li><a href="#">Marketing</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Hubungi Kami</h4>
            <ul>
                <li><a href="mailto:info@skillbridge.com">info@skillbridge.com</a></li>
                <li><a href="tel:+62123456789">+62 (123) 456-789</a></li>
                <li>Jl. Teknologi No. 123, Kota</li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 Skillbridge. Semua hak dilindungi. | <a href="#" style="color: #87ceeb;">Privacy Policy</a> | <a href="#" style="color: #87ceeb;">Terms of Service</a></p>
    </div>
</div>
