@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pelatihan - Skill Bridge</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 2rem;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #3498db;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .breadcrumb {
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .breadcrumb a {
            color: #3498db;
            text-decoration: none;
        }

        .content-wrapper {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .training-detail {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .training-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .training-header h1 {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .training-meta {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #ecf0f1;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meta-item .icon {
            color: #3498db;
            font-weight: bold;
        }

        .rating {
            color: #f39c12;
        }

        .section {
            margin-bottom: 2rem;
        }

        .section h2 {
            font-size: 1.3rem;
            color: #2c3e50;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #3498db;
        }

        .section p {
            line-height: 1.8;
            color: #555;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-top: 1rem;
        }

        .skill-tag {
            background: #e3f2fd;
            color: #2196f3;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .requirements-list {
            list-style: none;
            padding-left: 0;
        }

        .requirements-list li {
            padding: 0.8rem 0;
            border-bottom: 1px solid #ecf0f1;
            display: flex;
            align-items: center;
        }

        .requirements-list li:before {
            content: "✓";
            color: #27ae60;
            font-weight: bold;
            margin-right: 1rem;
        }

        .sidebar {
            position: sticky;
            top: 2rem;
            height: fit-content;
        }

        .info-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }

        .price {
            font-size: 2rem;
            color: #27ae60;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .price-old {
            text-decoration: line-through;
            color: #95a5a6;
            font-size: 1.2rem;
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0;
        }

        .info-list li {
            padding: 0.8rem 0;
            border-bottom: 1px solid #ecf0f1;
            display: flex;
            justify-content: space-between;
        }

        .info-list li:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #7f8c8d;
        }

        .info-value {
            font-weight: 600;
            color: #2c3e50;
        }

        .btn-primary {
            width: 100%;
            background: #3498db;
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-bottom: 0.8rem;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-secondary {
            width: 100%;
            background: white;
            color: #3498db;
            padding: 1rem;
            border: 2px solid #3498db;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: #e3f2fd;
        }

        .instructor-card {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .instructor-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .instructor-info h3 {
            font-size: 1rem;
            color: #2c3e50;
            margin-bottom: 0.3rem;
        }

        .instructor-info p {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        @media (max-width: 768px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }

            .training-meta {
                flex-direction: column;
                gap: 1rem;
            }

            .sidebar {
                position: static;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">🎓 Skill Bridge</div>
            <nav>
                <a href="index.html">Home</a>
                <a href="list_pelatihan.html">Pelatihan</a>
                <a href="list_pekerjaan.php">Loker</a>
                <a href="profil.html">Profil</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="breadcrumb">
            <a href="/">Home</a> / <a href="/pelatihan">Pelatihan</a> / <span id="breadcrumbTitle">Detail Pelatihan</span>
        </div>

        <div class="content-wrapper" id="contentWrapper">
            <!-- Static default content (pelatihan id=1) -->
            <div class="training-detail">
                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800" alt="Full Stack Web Development dengan React & Node.js" class="training-image">
                <a href="{{ route('pelatihan.edit', ['id' => 1]) }}">edit pelatihan</a>
                <div class="training-header">
                    <h1>Full Stack Web Development dengan React & Node.js</h1>
                    <div class="training-meta">
                        <div class="meta-item">
                            <span class="icon">⭐</span>
                            <a href="{{route('pelatihan.rating')}}">
                            <span class="rating">4.8 (1.245 rating)</span>
                            </a>
                        </div>
                        <div class="meta-item">
                            <span class="icon">👥</span>
                            <span>3.890 Peserta</span>
                        </div>
                        <div class="meta-item">
                            <span class="icon">📅</span>
                            <span>Update: Nov 2025</span>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h2>📖 Deskripsi Pelatihan</h2>
                    <p>Pelatihan komprehensif yang dirancang untuk membawa Anda dari pemula hingga menjadi Full Stack Developer yang handal. Dalam pelatihan ini, Anda akan mempelajari pengembangan aplikasi web modern menggunakan teknologi terkini seperti React.js untuk frontend dan Node.js dengan Express untuk backend. Materi disusun secara sistematis dengan project-based learning yang akan membantu Anda membangun portfolio yang kuat.</p>
                    <p style="margin-top: 1rem;">Setiap modul dilengkapi dengan studi kasus nyata dari industri, latihan praktikal, dan quiz untuk menguji pemahaman Anda. Di akhir pelatihan, Anda akan membangun aplikasi web lengkap dari nol yang siap untuk di-deploy.</p>
                </div>

                <div class="section">
                    <h2>🎯 Yang Akan Anda Pelajari</h2>
                    <div class="skills-list">
                        <span class="skill-tag">HTML5 & CSS3</span><span class="skill-tag">JavaScript ES6+</span><span class="skill-tag">React.js</span><span class="skill-tag">Node.js</span><span class="skill-tag">Express.js</span><span class="skill-tag">MongoDB</span><span class="skill-tag">REST API</span><span class="skill-tag">Authentication</span><span class="skill-tag">Git & GitHub</span><span class="skill-tag">Deployment</span>
                    </div>
                </div>

                <div class="section">
                    <h2>📋 Persyaratan</h2>
                    <ul class="requirements-list">
                        <li>Memiliki komputer/laptop dengan spesifikasi minimal RAM 4GB</li>
                        <li>Koneksi internet yang stabil</li>
                        <li>Motivasi belajar yang tinggi dan konsisten</li>
                        <li>Pengetahuan dasar pemrograman (diutamakan tapi tidak wajib)</li>
                        <li>Kemauan untuk mengerjakan project dan latihan</li>
                    </ul>
                </div>

                <div class="section">
                    <h2>📚 Materi Pelatihan</h2>
                    <ul class="requirements-list">
                        <li>Modul 1: Fundamental Web Development (HTML, CSS, JavaScript)</li>
                        <li>Modul 2: React.js - Component Based UI Development</li>
                        <li>Modul 3: State Management dengan Redux & Context API</li>
                        <li>Modul 4: Backend Development dengan Node.js & Express</li>
                        <li>Modul 5: Database MongoDB & Mongoose ODM</li>
                        <li>Modul 6: REST API Development & Integration</li>
                        <li>Modul 7: Authentication & Authorization</li>
                        <li>Modul 8: Testing & Debugging</li>
                        <li>Modul 9: Deployment & Production</li>
                        <li>Modul 10: Final Project - Build Complete Web Application</li>
                    </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <div class="info-card">
                    <div class="price">GRATIS</div>
                    <div class="price-old">Rp 1.500.000</div>

                    <ul class="info-list">
                        <li>
                            <span class="info-label">⏱️ Durasi</span>
                            <span class="info-value">12 Minggu</span>
                        </li>
                        <li>
                            <span class="info-label">📹 Video</span>
                            <span class="info-value">85 Video</span>
                        </li>
                        <li>
                            <span class="info-label">📄 Materi</span>
                            <span class="info-value">50+ Resources</span>
                        </li>
                        <li>
                            <span class="info-label">📱 Akses</span>
                            <span class="info-value">Selamanya</span>
                        </li>
                        <li>
                            <span class="info-label">🏆 Sertifikat</span>
                            <span class="info-value">Ya</span>
                        </li>
                        <li>
                            <span class="info-label">📊 Level</span>
                            <span class="info-value">Intermediate</span>
                        </li>
                    </ul>

                    <button class="btn-primary" onclick="alert('Fitur pendaftaran akan segera hadir!')">
                        Daftar Sekarang
                    </button>
                    <button class="btn-secondary" onclick="alert('Ditambahkan ke wishlist!')">
                        💾 Simpan ke Wishlist
                    </button>
                </div>

                <div class="info-card">
                    <h3 style="margin-bottom: 1rem; color: #2c3e50;">👨‍🏫 Instruktur</h3>
                    <div class="instructor-card">
                        <img src="https://i.pravatar.cc/150?img=12" alt="Instruktur" class="instructor-img">
                        <div class="instructor-info">
                            <h3>Ahmad Fauzi, S.Kom., M.T.</h3>
                            <p>Senior Full Stack Developer</p>
                            <p style="color: #f39c12;">⭐ 4.9 (2.340 reviews)</p>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <h3 style="margin-bottom: 1rem; color: #2c3e50;">💼 Peluang Karir</h3>
                    <p style="font-size: 0.9rem; line-height: 1.6; color: #555;">
                        Lulusan pelatihan ini memiliki kesempatan untuk bekerja di bidang Web Development
                    </p>
                    <a href="list_pekerjaan.php?kategori=Web Development" style="display: block; margin-top: 1rem; padding: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center; border-radius: 8px; text-decoration: none; font-weight: 600;">
                        🔍 Lihat Lowongan Terkait
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Database pelatihan lengkap
        const pelatihanData = {
            1: {
                id: 1,
                title: 'Full Stack Web Development dengan React & Node.js',
                instructor: 'Ahmad Fauzi, S.Kom., M.T.',
                instructorTitle: 'Senior Full Stack Developer',
                instructorRating: 4.9,
                instructorReviews: 2340,
                category: 'Web Development',
                level: 'Intermediate',
                duration: '12 Minggu',
                videos: 85,
                rating: 4.8,
                ratingCount: 1245,
                students: 3890,
                price: 'GRATIS',
                priceOld: 'Rp 1.500.000',
                updateDate: 'Nov 2025',
                imageUrl: 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800',
                description: 'Pelatihan komprehensif yang dirancang untuk membawa Anda dari pemula hingga menjadi Full Stack Developer yang handal. Dalam pelatihan ini, Anda akan mempelajari pengembangan aplikasi web modern menggunakan teknologi terkini seperti React.js untuk frontend dan Node.js dengan Express untuk backend. Materi disusun secara sistematis dengan project-based learning yang akan membantu Anda membangun portfolio yang kuat.',
                description2: 'Setiap modul dilengkapi dengan studi kasus nyata dari industri, latihan praktikal, dan quiz untuk menguji pemahaman Anda. Di akhir pelatihan, Anda akan membangun aplikasi web lengkap dari nol yang siap untuk di-deploy.',
                skills: ['HTML5 & CSS3', 'JavaScript ES6+', 'React.js', 'Node.js', 'Express.js', 'MongoDB', 'REST API', 'Authentication', 'Git & GitHub', 'Deployment'],
                requirements: [
                    'Memiliki komputer/laptop dengan spesifikasi minimal RAM 4GB',
                    'Koneksi internet yang stabil',
                    'Motivasi belajar yang tinggi dan konsisten',
                    'Pengetahuan dasar pemrograman (diutamakan tapi tidak wajib)',
                    'Kemauan untuk mengerjakan project dan latihan'
                ],
                modules: [
                    'Modul 1: Fundamental Web Development (HTML, CSS, JavaScript)',
                    'Modul 2: React.js - Component Based UI Development',
                    'Modul 3: State Management dengan Redux & Context API',
                    'Modul 4: Backend Development dengan Node.js & Express',
                    'Modul 5: Database MongoDB & Mongoose ODM',
                    'Modul 6: REST API Development & Integration',
                    'Modul 7: Authentication & Authorization',
                    'Modul 8: Testing & Debugging',
                    'Modul 9: Deployment & Production',
                    'Modul 10: Final Project - Build Complete Web Application'
                ],
                resources: '50+',
                access: 'Selamanya',
                certificate: 'Ya'
            },
            2: {
                id: 2,
                title: 'Mobile App Development dengan Flutter',
                instructor: 'Siti Nurhaliza, S.T., M.Kom.',
                instructorTitle: 'Mobile Development Expert',
                instructorRating: 4.8,
                instructorReviews: 1890,
                category: 'Mobile Development',
                level: 'Intermediate',
                duration: '10 Minggu',
                videos: 75,
                rating: 4.7,
                ratingCount: 890,
                students: 2450,
                price: 'GRATIS',
                priceOld: 'Rp 1.200.000',
                updateDate: 'Nov 2025',
                imageUrl: 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800',
                description: 'Pelajari cara membuat aplikasi mobile cross-platform dengan Flutter. Pelatihan ini mencakup dasar-dasar Dart programming, widget Flutter, state management, API integration, hingga publishing aplikasi ke Play Store dan App Store.',
                description2: 'Dengan Flutter, Anda dapat membuat aplikasi iOS dan Android menggunakan single codebase. Hemat waktu dan biaya pengembangan sambil tetap mendapatkan performa native yang luar biasa.',
                skills: ['Dart Programming', 'Flutter Framework', 'State Management', 'Firebase', 'REST API', 'Local Storage', 'UI/UX Design', 'App Publishing'],
                requirements: [
                    'Laptop/PC dengan RAM minimal 8GB',
                    'Android Studio atau VS Code terinstall',
                    'Pengetahuan dasar programming',
                    'Smartphone untuk testing',
                    'Koneksi internet stabil'
                ],
                modules: [
                    'Modul 1: Introduction to Dart Programming',
                    'Modul 2: Flutter Basics - Widgets & Layouts',
                    'Modul 3: Navigation & Routing',
                    'Modul 4: State Management dengan Provider',
                    'Modul 5: Firebase Integration',
                    'Modul 6: REST API & HTTP Requests',
                    'Modul 7: Local Database dengan SQLite',
                    'Modul 8: Advanced UI & Animations',
                    'Modul 9: Testing & Debugging',
                    'Modul 10: Publishing to Stores'
                ],
                resources: '45+',
                access: 'Selamanya',
                certificate: 'Ya'
            },
            3: {
                id: 3,
                title: 'UI/UX Design Mastery - From Zero to Hero',
                instructor: 'Dina Mariana, S.Ds., M.Des.',
                instructorTitle: 'Lead Product Designer',
                instructorRating: 4.9,
                instructorReviews: 2156,
                category: 'Design',
                level: 'Beginner',
                duration: '8 Minggu',
                videos: 60,
                rating: 4.8,
                ratingCount: 1678,
                students: 3120,
                price: 'GRATIS',
                priceOld: 'Rp 1.000.000',
                updateDate: 'Nov 2025',
                imageUrl: 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=800',
                description: 'Kuasai seni dan sains UI/UX Design dari nol. Pelajari design thinking, user research, wireframing, prototyping, dan usability testing. Gunakan tools profesional seperti Figma dan Adobe XD.',
                description2: 'Pelatihan ini tidak hanya tentang membuat design yang cantik, tapi juga tentang memahami user needs dan creating meaningful experiences.',
                skills: ['Design Thinking', 'User Research', 'Wireframing', 'Prototyping', 'Figma', 'Adobe XD', 'Usability Testing', 'Design System'],
                requirements: [
                    'Laptop/PC dengan spesifikasi standar',
                    'Install Figma (gratis) atau Adobe XD',
                    'Tidak perlu background design',
                    'Kreativitas dan passion untuk design'
                ],
                modules: [
                    'Modul 1: Introduction to UI/UX Design',
                    'Modul 2: Design Thinking & User Research',
                    'Modul 3: Information Architecture',
                    'Modul 4: Wireframing & Prototyping',
                    'Modul 5: Visual Design Principles',
                    'Modul 6: Figma Mastery',
                    'Modul 7: Design System',
                    'Modul 8: Interaction Design',
                    'Modul 9: Usability Testing',
                    'Modul 10: Portfolio Creation'
                ],
                resources: '60+',
                access: 'Selamanya',
                certificate: 'Ya'
            },
            4: {
                id: 4,
                title: 'Data Science & Machine Learning dengan Python',
                instructor: 'Dr. Bambang Sutrisno, M.Sc.',
                instructorTitle: 'Data Science Lead',
                instructorRating: 4.9,
                instructorReviews: 1567,
                category: 'Data Science',
                level: 'Advanced',
                duration: '16 Minggu',
                videos: 100,
                rating: 4.9,
                ratingCount: 945,
                students: 1890,
                price: 'GRATIS',
                priceOld: 'Rp 2.000.000',
                updateDate: 'Nov 2025',
                imageUrl: 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800',
                description: 'Deep dive into Data Science dan Machine Learning. Pelajari Python, Pandas, NumPy, Scikit-learn, dan TensorFlow. Dari data cleaning hingga building ML models.',
                description2: 'Pelatihan hands-on dengan real-world datasets. Bangun portfolio projects yang impressive untuk kickstart karir sebagai Data Scientist.',
                skills: ['Python', 'Pandas & NumPy', 'Data Visualization', 'Statistics', 'Machine Learning', 'Deep Learning', 'TensorFlow', 'SQL'],
                requirements: [
                    'Laptop dengan RAM minimal 8GB',
                    'Basic programming knowledge',
                    'Matematika dasar',
                    'Python terinstall',
                    'Dedikasi 10-15 jam/minggu'
                ],
                modules: [
                    'Modul 1: Python for Data Science',
                    'Modul 2: Data Manipulation',
                    'Modul 3: Data Visualization',
                    'Modul 4: Statistics',
                    'Modul 5: ML Fundamentals',
                    'Modul 6: Supervised Learning',
                    'Modul 7: Unsupervised Learning',
                    'Modul 8: Deep Learning',
                    'Modul 9: NLP',
                    'Modul 10: Computer Vision'
                ],
                resources: '80+',
                access: 'Selamanya',
                certificate: 'Ya'
            }
        };

        // Get URL parameter
        function getUrlParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Render detail pelatihan
        function renderDetail(data) {
            document.getElementById('breadcrumbTitle').textContent = data.title;

            document.getElementById('contentWrapper').innerHTML = `
                <!-- Main Content -->
                <div class="training-detail">
                    <img src="${data.imageUrl}" alt="${data.title}" class="training-image">

                    <div class="training-header">
                        <h1>${data.title}</h1>
                        <div class="training-meta">
                            <div class="meta-item">
                                <span class="icon">⭐</span>
                                <span class="rating">${data.rating} (${data.ratingCount.toLocaleString('id-ID')} rating)</span>
                            </div>
                            <div class="meta-item">
                                <span class="icon">👥</span>
                                <span>${data.students.toLocaleString('id-ID')} Peserta</span>
                            </div>
                            <div class="meta-item">
                                <span class="icon">📅</span>
                                <span>Update: ${data.updateDate}</span>
                            </div>
                        </div>
                    </div>

                    <div class="section">
                        <h2>📖 Deskripsi Pelatihan</h2>
                        <p>${data.description}</p>
                        <p style="margin-top: 1rem;">${data.description2}</p>
                    </div>

                    <div class="section">
                        <h2>🎯 Yang Akan Anda Pelajari</h2>
                        <div class="skills-list">
                            ${data.skills.map(skill => `<span class="skill-tag">${skill}</span>`).join('')}
                        </div>
                    </div>

                    <div class="section">
                        <h2>📋 Persyaratan</h2>
                        <ul class="requirements-list">
                            ${data.requirements.map(req => `<li>${req}</li>`).join('')}
                        </ul>
                    </div>

                    <div class="section">
                        <h2>📚 Materi Pelatihan</h2>
                        <ul class="requirements-list">
                            ${data.modules.map(module => `<li>${module}</li>`).join('')}
                        </ul>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="info-card">
                        <div class="price">${data.price}</div>
                        <div class="price-old">${data.priceOld}</div>

                        <ul class="info-list">
                            <li>
                                <span class="info-label">⏱️ Durasi</span>
                                <span class="info-value">${data.duration}</span>
                            </li>
                            <li>
                                <span class="info-label">📹 Video</span>
                                <span class="info-value">${data.videos} Video</span>
                            </li>
                            <li>
                                <span class="info-label">📄 Materi</span>
                                <span class="info-value">${data.resources} Resources</span>
                            </li>
                            <li>
                                <span class="info-label">📱 Akses</span>
                                <span class="info-value">${data.access}</span>
                            </li>
                            <li>
                                <span class="info-label">🏆 Sertifikat</span>
                                <span class="info-value">${data.certificate}</span>
                            </li>
                            <li>
                                <span class="info-label">📊 Level</span>
                                <span class="info-value">${data.level}</span>
                            </li>
                        </ul>

                        <button class="btn-primary" onclick="alert('Fitur pendaftaran akan segera hadir!')">
                            Daftar Sekarang
                        </button>
                        <button class="btn-secondary" onclick="alert('Ditambahkan ke wishlist!')">
                            💾 Simpan ke Wishlist
                        </button>
                    </div>

                    <div class="info-card">
                        <h3 style="margin-bottom: 1rem; color: #2c3e50;">👨‍🏫 Instruktur</h3>
                        <div class="instructor-card">
                            <img src="https://i.pravatar.cc/150?img=12" alt="Instruktur" class="instructor-img">
                            <div class="instructor-info">
                                <h3>${data.instructor}</h3>
                                <p>${data.instructorTitle}</p>
                                <p style="color: #f39c12;">⭐ ${data.instructorRating} (${data.instructorReviews.toLocaleString('id-ID')} reviews)</p>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <h3 style="margin-bottom: 1rem; color: #2c3e50;">💼 Peluang Karir</h3>
                        <p style="font-size: 0.9rem; line-height: 1.6; color: #555;">
                            Lulusan pelatihan ini memiliki kesempatan untuk bekerja di bidang ${data.category}
                        </p>
                        <a href="list_pekerjaan.php?kategori=${data.category}" style="display: block; margin-top: 1rem; padding: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center; border-radius: 8px; text-decoration: none; font-weight: 600;">
                            🔍 Lihat Lowongan Terkait
                        </a>
                    </div>
                </div>
            `;
        }

        // Initialize — ubah: jika tidak ada parameter id, biarkan konten statis default
        window.addEventListener('DOMContentLoaded', () => {
            const pelatihanId = getUrlParameter('id');
            if (!pelatihanId) {
                // Tidak ada parameter id -> biarkan konten HTML statis (default) tetap
                return;
            }

            const data = pelatihanData[pelatihanId];

            if (data) {
                renderDetail(data);
            } else {
                document.getElementById('contentWrapper').innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 4rem; background: white; border-radius: 12px;">
                        <h2>❌ Pelatihan Tidak Ditemukan</h2>
                        <p>ID pelatihan tidak valid atau tidak ditemukan</p>
                        <button class="btn-primary" style="max-width: 300px; margin: 2rem auto;" onclick="window.location.href='list_pelatihan.html'">
                            Kembali ke Daftar Pelatihan
                        </button>
                    </div>
                `;
            }
        });
    </script>
</body>
</html>
@endsection
