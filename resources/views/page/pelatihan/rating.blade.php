@extends('layout.main')
@section('content')
<html lang="id"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating &amp; Review - Skill Bridge</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* Rating Summary */
        .rating-summary {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .summary-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 3rem;
        }

        .overall-rating {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            color: white;
        }

        .rating-number {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .rating-stars {
            font-size: 1.5rem;
            color: #ffd700;
            margin-bottom: 0.5rem;
        }

        .rating-count {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .rating-breakdown {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .rating-row {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .rating-label {
            min-width: 80px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .rating-bar {
            flex: 1;
            height: 12px;
            background: #e0e0e0;
            border-radius: 6px;
            overflow: hidden;
        }

        .rating-fill {
            height: 100%;
            background: linear-gradient(90deg, #ffd700 0%, #ffa500 100%);
            transition: width 0.3s ease;
        }

        .rating-percent {
            min-width: 50px;
            text-align: right;
            font-size: 0.9rem;
            color: #666;
        }

        /* Filter & Sort */
        .review-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .filter-buttons {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.6rem 1.2rem;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-btn:hover {
            border-color: #3498db;
        }

        .filter-btn.active {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }

        .sort-select {
            padding: 0.6rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            font-size: 0.9rem;
        }

        /* Write Review Button */
        .btn-write-review {
            background: #27ae60;
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-write-review:hover {
            background: #229954;
        }

        /* Reviews List */
        .reviews-container {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .review-card {
            padding: 1.5rem 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .review-card:last-child {
            border-bottom: none;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .reviewer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .reviewer-details h4 {
            font-size: 1rem;
            color: #2c3e50;
            margin-bottom: 0.3rem;
        }

        .reviewer-meta {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .review-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stars {
            color: #ffd700;
            font-size: 1rem;
        }

        .review-date {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .review-content {
            line-height: 1.8;
            color: #555;
            margin-bottom: 1rem;
        }

        .review-helpful {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            font-size: 0.9rem;
        }

        .helpful-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            border: 1px solid #e0e0e0;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .helpful-btn:hover {
            border-color: #3498db;
            background: #f0f8ff;
        }

        .helpful-btn.active {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-header h2 {
            color: #2c3e50;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #999;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .star-rating-input {
            display: flex;
            gap: 0.5rem;
            font-size: 2rem;
        }

        .star-input {
            cursor: pointer;
            color: #ddd;
            transition: color 0.2s;
        }

        .star-input:hover,
        .star-input.active {
            color: #ffd700;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: #3498db;
        }

        textarea.form-input {
            min-height: 150px;
            resize: vertical;
        }

        .btn-submit {
            width: 100%;
            background: #3498db;
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #2980b9;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .page-btn {
            padding: 0.6rem 1rem;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .page-btn:hover {
            border-color: #3498db;
        }

        .page-btn.active {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .summary-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .review-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-buttons {
                justify-content: center;
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
            <a href="index.html">Home</a> / 
            <a href="list_pelatihan.html">Pelatihan</a> / 
            <a href="detail_pelatihan.html?id=1">Full Stack Web Development</a> / 
            Rating &amp; Review
        </div>

        <!-- Rating Summary -->
        <div class="rating-summary">
            <div class="summary-grid">
                <div class="overall-rating">
                    <div class="rating-number">4.8</div>
                    <div class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="rating-count">Berdasarkan 1,245 review</div>
                </div>

                <div class="rating-breakdown">
                    <div class="rating-row">
                        <div class="rating-label">
                            <span>5</span>
                            <i class="fas fa-star" style="color: #ffd700;"></i>
                        </div>
                        <div class="rating-bar">
                            <div class="rating-fill" style="width: 75%"></div>
                        </div>
                        <div class="rating-percent">75%</div>
                    </div>
                    <div class="rating-row">
                        <div class="rating-label">
                            <span>4</span>
                            <i class="fas fa-star" style="color: #ffd700;"></i>
                        </div>
                        <div class="rating-bar">
                            <div class="rating-fill" style="width: 18%"></div>
                        </div>
                        <div class="rating-percent">18%</div>
                    </div>
                    <div class="rating-row">
                        <div class="rating-label">
                            <span>3</span>
                            <i class="fas fa-star" style="color: #ffd700;"></i>
                        </div>
                        <div class="rating-bar">
                            <div class="rating-fill" style="width: 5%"></div>
                        </div>
                        <div class="rating-percent">5%</div>
                    </div>
                    <div class="rating-row">
                        <div class="rating-label">
                            <span>2</span>
                            <i class="fas fa-star" style="color: #ffd700;"></i>
                        </div>
                        <div class="rating-bar">
                            <div class="rating-fill" style="width: 1%"></div>
                        </div>
                        <div class="rating-percent">1%</div>
                    </div>
                    <div class="rating-row">
                        <div class="rating-label">
                            <span>1</span>
                            <i class="fas fa-star" style="color: #ffd700;"></i>
                        </div>
                        <div class="rating-bar">
                            <div class="rating-fill" style="width: 1%"></div>
                        </div>
                        <div class="rating-percent">1%</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <div class="review-controls">
            <div class="filter-buttons">
                <button class="filter-btn active" onclick="filterReviews('all')">
                    Semua Review
                </button>
                <button class="filter-btn" onclick="filterReviews(5)">
                    <i class="fas fa-star"></i> 5
                </button>
                <button class="filter-btn" onclick="filterReviews(4)">
                    <i class="fas fa-star"></i> 4
                </button>
                <button class="filter-btn" onclick="filterReviews(3)">
                    <i class="fas fa-star"></i> 3
                </button>
                <button class="filter-btn" onclick="filterReviews(2)">
                    <i class="fas fa-star"></i> 2
                </button>
                <button class="filter-btn" onclick="filterReviews(1)">
                    <i class="fas fa-star"></i> 1
                </button>
            </div>

            <div style="display: flex; gap: 1rem; align-items: center;">
                <select class="sort-select" onchange="sortReviews(this.value)">
                    <option value="helpful">Paling Membantu</option>
                    <option value="newest">Terbaru</option>
                    <option value="highest">Rating Tertinggi</option>
                    <option value="lowest">Rating Terendah</option>
                </select>

                <button class="btn-write-review" onclick="openReviewModal()">
                    <i class="fas fa-pen"></i> Tulis Review
                </button>
            </div>
        </div>

        <!-- Reviews List -->
        <div class="reviews-container" id="reviewsContainer">
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">B</div>
                            <div class="reviewer-details">
                                <h4>Budi Santoso</h4>
                                <div class="reviewer-meta">
                                    <span class="stars">★★★★★</span>
                                    <span> • 2 hari yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 style="margin-bottom: 0.8rem; color: #2c3e50;">Pelatihan yang sangat comprehensive!</h4>
                    <p class="review-content">Materi sangat lengkap dan terstruktur dengan baik. Instruktur menjelaskan dengan detail dan mudah dipahami. Project-based learning sangat membantu untuk praktik langsung. Setelah menyelesaikan pelatihan ini, saya berhasil mendapat pekerjaan sebagai Full Stack Developer. Highly recommended!</p>

                    <div class="review-helpful">
                        <span style="color: #7f8c8d;">Apakah review ini membantu?</span>
                        <button class="helpful-btn " onclick="markHelpful(1, true)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Ya (245)</span>
                        </button>
                        <button class="helpful-btn active" onclick="markHelpful(1, false)">
                            <i class="fas fa-thumbs-down"></i>
                            <span>Tidak (3)</span>
                        </button>
                    </div>
                </div>
            
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">S</div>
                            <div class="reviewer-details">
                                <h4>Siti Rahma</h4>
                                <div class="reviewer-meta">
                                    <span class="stars">★★★★★</span>
                                    <span> • 1 minggu yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 style="margin-bottom: 0.8rem; color: #2c3e50;">Best investment untuk karir saya!</h4>
                    <p class="review-content">Sebagai pemula yang tidak punya background IT, awalnya saya ragu. Tapi ternyata materi dijelaskan dari dasar sekali. Pace pembelajaran pas, tidak terlalu cepat atau lambat. Video tutorialnya berkualitas HD dan suaranya jelas. Support dari komunitas juga luar biasa helpful!</p>

                    <div class="review-helpful">
                        <span style="color: #7f8c8d;">Apakah review ini membantu?</span>
                        <button class="helpful-btn " onclick="markHelpful(2, true)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Ya (189)</span>
                        </button>
                        <button class="helpful-btn active" onclick="markHelpful(2, false)">
                            <i class="fas fa-thumbs-down"></i>
                            <span>Tidak (2)</span>
                        </button>
                    </div>
                </div>
            
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">A</div>
                            <div class="reviewer-details">
                                <h4>Ahmad Firdaus</h4>
                                <div class="reviewer-meta">
                                    <span class="stars">★★★★☆</span>
                                    <span> • 2 minggu yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 style="margin-bottom: 0.8rem; color: #2c3e50;">Bagus, tapi perlu update beberapa materi</h4>
                    <p class="review-content">Overall pelatihannya bagus dan worth it. Materi React dan Node.js sangat lengkap. Namun ada beberapa library yang sudah deprecated dan perlu update ke versi terbaru. Tapi ini minor issue, karena konsep dasarnya tetap sama. Instruktur responsif dalam menjawab pertanyaan di forum.</p>

                    <div class="review-helpful">
                        <span style="color: #7f8c8d;">Apakah review ini membantu?</span>
                        <button class="helpful-btn " onclick="markHelpful(3, true)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Ya (156)</span>
                        </button>
                        <button class="helpful-btn active" onclick="markHelpful(3, false)">
                            <i class="fas fa-thumbs-down"></i>
                            <span>Tidak (8)</span>
                        </button>
                    </div>
                </div>
            
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">D</div>
                            <div class="reviewer-details">
                                <h4>Dewi Lestari</h4>
                                <div class="reviewer-meta">
                                    <span class="stars">★★★★★</span>
                                    <span> • 3 minggu yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 style="margin-bottom: 0.8rem; color: #2c3e50;">Dari nol sampai bisa deploy!</h4>
                    <p class="review-content">Saya mulai dari benar-benar nol pengetahuan coding. Setelah 3 bulan belajar konsisten, sekarang saya sudah bisa buat website fullstack dan deploy sendiri. Final project-nya challenging tapi satisfying banget pas berhasil! Thank you Skill Bridge!</p>

                    <div class="review-helpful">
                        <span style="color: #7f8c8d;">Apakah review ini membantu?</span>
                        <button class="helpful-btn " onclick="markHelpful(4, true)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Ya (234)</span>
                        </button>
                        <button class="helpful-btn active" onclick="markHelpful(4, false)">
                            <i class="fas fa-thumbs-down"></i>
                            <span>Tidak (5)</span>
                        </button>
                    </div>
                </div>
            
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">R</div>
                            <div class="reviewer-details">
                                <h4>Ricky Pratama</h4>
                                <div class="reviewer-meta">
                                    <span class="stars">★★★★★</span>
                                    <span> • 1 bulan yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 style="margin-bottom: 0.8rem; color: #2c3e50;">Materi terstruktur dan mentor responsif</h4>
                    <p class="review-content">Struktur materinya sangat bagus, dimulai dari fundamental sampai advanced topics. Yang paling saya suka adalah mentor selalu siap membantu ketika stuck. Response time-nya cepat dan penjelasannya detail. Bonus materials seperti tips interview dan portfolio building juga sangat membantu.</p>

                    <div class="review-helpful">
                        <span style="color: #7f8c8d;">Apakah review ini membantu?</span>
                        <button class="helpful-btn " onclick="markHelpful(5, true)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Ya (198)</span>
                        </button>
                        <button class="helpful-btn active" onclick="markHelpful(5, false)">
                            <i class="fas fa-thumbs-down"></i>
                            <span>Tidak (4)</span>
                        </button>
                    </div>
                </div>
            
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">L</div>
                            <div class="reviewer-details">
                                <h4>Linda Wijaya</h4>
                                <div class="reviewer-meta">
                                    <span class="stars">★★★★☆</span>
                                    <span> • 1 bulan yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 style="margin-bottom: 0.8rem; color: #2c3e50;">Great content, butuh dedikasi tinggi</h4>
                    <p class="review-content">Kontennya sangat bagus dan in-depth. Tapi harus siap dedikasi waktu yang cukup banyak karena materinya padat. Bagi yang kerja sambil belajar mungkin perlu time management yang baik. Tapi hasil akhirnya sebanding dengan effort yang dikeluarkan!</p>

                    <div class="review-helpful">
                        <span style="color: #7f8c8d;">Apakah review ini membantu?</span>
                        <button class="helpful-btn " onclick="markHelpful(6, true)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Ya (142)</span>
                        </button>
                        <button class="helpful-btn active" onclick="markHelpful(6, false)">
                            <i class="fas fa-thumbs-down"></i>
                            <span>Tidak (12)</span>
                        </button>
                    </div>
                </div>
            
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">E</div>
                            <div class="reviewer-details">
                                <h4>Eko Prasetyo</h4>
                                <div class="reviewer-meta">
                                    <span class="stars">★★★★★</span>
                                    <span> • 1 bulan yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 style="margin-bottom: 0.8rem; color: #2c3e50;">Pelatihan terbaik yang pernah saya ikuti</h4>
                    <p class="review-content">Sudah ikut beberapa bootcamp lain, tapi Skill Bridge ini yang terbaik. Materinya up to date, praktiknya banyak, dan yang paling penting ada career support setelah lulus. Saya dapat referensi ke beberapa perusahaan dan alhamdulillah diterima di salah satunya.</p>

                    <div class="review-helpful">
                        <span style="color: #7f8c8d;">Apakah review ini membantu?</span>
                        <button class="helpful-btn " onclick="markHelpful(7, true)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Ya (287)</span>
                        </button>
                        <button class="helpful-btn active" onclick="markHelpful(7, false)">
                            <i class="fas fa-thumbs-down"></i>
                            <span>Tidak (1)</span>
                        </button>
                    </div>
                </div>
            
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">M</div>
                            <div class="reviewer-details">
                                <h4>Maya Anggraini</h4>
                                <div class="reviewer-meta">
                                    <span class="stars">★★★☆☆</span>
                                    <span> • 2 bulan yang lalu</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 style="margin-bottom: 0.8rem; color: #2c3e50;">Bagus tapi pace-nya agak cepat</h4>
                    <p class="review-content">Materinya bagus dan lengkap, tapi menurut saya pace pembelajaran agak terlalu cepat terutama untuk pemula. Mungkin bisa diperlambat atau dibagi menjadi beginner dan intermediate track. Tapi overall tetap worth it untuk dipelajari.</p>

                    <div class="review-helpful">
                        <span style="color: #7f8c8d;">Apakah review ini membantu?</span>
                        <button class="helpful-btn " onclick="markHelpful(8, true)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Ya (78)</span>
                        </button>
                        <button class="helpful-btn active" onclick="markHelpful(8, false)">
                            <i class="fas fa-thumbs-down"></i>
                            <span>Tidak (34)</span>
                        </button>
                    </div>
                </div>
            </div>
    </div>

    <!-- Review Modal -->
    <div class="modal" id="reviewModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tulis Review</h2>
                <button class="close-btn" onclick="closeReviewModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form onsubmit="submitReview(event)">
                <div class="form-group">
                    <label>Rating</label>
                    <div class="star-rating-input" id="starRatingInput">
                        <i class="fas fa-star star-input" data-rating="1"></i>
                        <i class="fas fa-star star-input" data-rating="2"></i>
                        <i class="fas fa-star star-input" data-rating="3"></i>
                        <i class="fas fa-star star-input" data-rating="4"></i>
                        <i class="fas fa-star star-input" data-rating="5"></i>
                    </div>
                    <input type="hidden" id="ratingValue" required="">
                </div>

                <div class="form-group">
                    <label>Judul Review</label>
                    <input type="text" class="form-input" id="reviewTitle" placeholder="Ringkasan singkat pengalaman Anda" required="">
                </div>

                <div class="form-group">
                    <label>Review Anda</label>
                    <textarea class="form-input" id="reviewText" placeholder="Ceritakan pengalaman Anda mengikuti pelatihan ini..." required=""></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Submit Review
                </button>
            </form>
        </div>
    </div>

    <script>
        // Sample reviews data
        const reviewsData = [
            {
                id: 1,
                name: 'Budi Santoso',
                avatar: 'B',
                rating: 5,
                date: '2 hari yang lalu',
                title: 'Pelatihan yang sangat comprehensive!',
                content: 'Materi sangat lengkap dan terstruktur dengan baik. Instruktur menjelaskan dengan detail dan mudah dipahami. Project-based learning sangat membantu untuk praktik langsung. Setelah menyelesaikan pelatihan ini, saya berhasil mendapat pekerjaan sebagai Full Stack Developer. Highly recommended!',
                helpful: 245,
                unhelpful: 3,
                isHelpful: false
            },
            {
                id: 2,
                name: 'Siti Rahma',
                avatar: 'S',
                rating: 5,
                date: '1 minggu yang lalu',
                title: 'Best investment untuk karir saya!',
                content: 'Sebagai pemula yang tidak punya background IT, awalnya saya ragu. Tapi ternyata materi dijelaskan dari dasar sekali. Pace pembelajaran pas, tidak terlalu cepat atau lambat. Video tutorialnya berkualitas HD dan suaranya jelas. Support dari komunitas juga luar biasa helpful!',
                helpful: 189,
                unhelpful: 2,
                isHelpful: false
            },
            {
                id: 3,
                name: 'Ahmad Firdaus',
                avatar: 'A',
                rating: 4,
                date: '2 minggu yang lalu',
                title: 'Bagus, tapi perlu update beberapa materi',
                content: 'Overall pelatihannya bagus dan worth it. Materi React dan Node.js sangat lengkap. Namun ada beberapa library yang sudah deprecated dan perlu update ke versi terbaru. Tapi ini minor issue, karena konsep dasarnya tetap sama. Instruktur responsif dalam menjawab pertanyaan di forum.',
                helpful: 156,
                unhelpful: 8,
                isHelpful: false
            },
            {
                id: 4,
                name: 'Dewi Lestari',
                avatar: 'D',
                rating: 5,
                date: '3 minggu yang lalu',
                title: 'Dari nol sampai bisa deploy!',
                content: 'Saya mulai dari benar-benar nol pengetahuan coding. Setelah 3 bulan belajar konsisten, sekarang saya sudah bisa buat website fullstack dan deploy sendiri. Final project-nya challenging tapi satisfying banget pas berhasil! Thank you Skill Bridge!',
                helpful: 234,
                unhelpful: 5,
                isHelpful: false
            },
            {
                id: 5,
                name: 'Ricky Pratama',
                avatar: 'R',
                rating: 5,
                date: '1 bulan yang lalu',
                title: 'Materi terstruktur dan mentor responsif',
                content: 'Struktur materinya sangat bagus, dimulai dari fundamental sampai advanced topics. Yang paling saya suka adalah mentor selalu siap membantu ketika stuck. Response time-nya cepat dan penjelasannya detail. Bonus materials seperti tips interview dan portfolio building juga sangat membantu.',
                helpful: 198,
                unhelpful: 4,
                isHelpful: false
            },
            {
                id: 6,
                name: 'Linda Wijaya',
                avatar: 'L',
                rating: 4,
                date: '1 bulan yang lalu',
                title: 'Great content, butuh dedikasi tinggi',
                content: 'Kontennya sangat bagus dan in-depth. Tapi harus siap dedikasi waktu yang cukup banyak karena materinya padat. Bagi yang kerja sambil belajar mungkin perlu time management yang baik. Tapi hasil akhirnya sebanding dengan effort yang dikeluarkan!',
                helpful: 142,
                unhelpful: 12,
                isHelpful: false
            },
            {
                id: 7,
                name: 'Eko Prasetyo',
                avatar: 'E',
                rating: 5,
                date: '1 bulan yang lalu',
                title: 'Pelatihan terbaik yang pernah saya ikuti',
                content: 'Sudah ikut beberapa bootcamp lain, tapi Skill Bridge ini yang terbaik. Materinya up to date, praktiknya banyak, dan yang paling penting ada career support setelah lulus. Saya dapat referensi ke beberapa perusahaan dan alhamdulillah diterima di salah satunya.',
                helpful: 287,
                unhelpful: 1,
                isHelpful: false
            },
            {
                id: 8,
                name: 'Maya Anggraini',
                avatar: 'M',
                rating: 3,
                date: '2 bulan yang lalu',
                title: 'Bagus tapi pace-nya agak cepat',
                content: 'Materinya bagus dan lengkap, tapi menurut saya pace pembelajaran agak terlalu cepat terutama untuk pemula. Mungkin bisa diperlambat atau dibagi menjadi beginner dan intermediate track. Tapi overall tetap worth it untuk dipelajari.',
                helpful: 78,
                unhelpful: 34,
                isHelpful: false
            }
        ];

        let currentReviews = [...reviewsData];
        let selectedRating = 0;

        // Render reviews
        function renderReviews(reviews) {
            const container = document.getElementById('reviewsContainer');
            
            if (reviews.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-comments"></i>
                        <h3>Belum Ada Review</h3>
                        <p>Jadilah yang pertama memberikan review untuk pelatihan ini!</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = reviews.map(review => `
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">${review.avatar}</div>
                            <div class="reviewer-details">
                                <h4>${review.name}</h4>
                                <div class="reviewer-meta">
                                    <span class="stars">${'★'.repeat(review.rating)}${'☆'.repeat(5-review.rating)}</span>
                                    <span> • ${review.date}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 style="margin-bottom: 0.8rem; color: #2c3e50;">${review.title}</h4>
                    <p class="review-content">${review.content}</p>

                    <div class="review-helpful">
                        <span style="color: #7f8c8d;">Apakah review ini membantu?</span>
                        <button class="helpful-btn ${review.isHelpful ? 'active' : ''}" onclick="markHelpful(${review.id}, true)">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Ya (${review.helpful})</span>
                        </button>
                        <button class="helpful-btn ${review.isHelpful === false ? 'active' : ''}" onclick="markHelpful(${review.id}, false)">
                            <i class="fas fa-thumbs-down"></i>
                            <span>Tidak (${review.unhelpful})</span>
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Filter reviews
        function filterReviews(rating) {
            // Update active button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            if (rating === 'all') {
                currentReviews = [...reviewsData];
            } else {
                currentReviews = reviewsData.filter(r => r.rating === rating);
            }
            renderReviews(currentReviews);
        }

        // Sort reviews
        function sortReviews(sortBy) {
            switch(sortBy) {
                case 'helpful':
                    currentReviews.sort((a, b) => b.helpful - a.helpful);
                    break;
                case 'newest':
                    currentReviews.sort((a, b) => a.id - b.id);
                    break;
                case 'highest':
                    currentReviews.sort((a, b) => b.rating - a.rating);
                    break;
                case 'lowest':
                    currentReviews.sort((a, b) => a.rating - b.rating);
                    break;
            }
            renderReviews(currentReviews);
        }

        // Mark helpful
        function markHelpful(reviewId, isHelpful) {
            const review = reviewsData.find(r => r.id === reviewId);
            if (review) {
                if (isHelpful) {
                    review.helpful++;
                    review.isHelpful = true;
                } else {
                    review.unhelpful++;
                    review.isHelpful = false;
                }
                renderReviews(currentReviews);
            }
        }

        // Modal functions
        function openReviewModal() {
            document.getElementById('reviewModal').classList.add('active');
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').classList.remove('active');
            document.getElementById('ratingValue').value = '';
            document.querySelectorAll('.star-input').forEach(star => {
                star.classList.remove('active');
            });
        }

        // Star rating input
        document.querySelectorAll('.star-input').forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.rating);
                document.getElementById('ratingValue').value = selectedRating;
                
                // Update visual
                document.querySelectorAll('.star-input').forEach((s, index) => {
                    if (index < selectedRating) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });
            });

            star.addEventListener('mouseenter', function() {
                const rating = parseInt(this.dataset.rating);
                document.querySelectorAll('.star-input').forEach((s, index) => {
                    if (index < rating) {
                        s.style.color = '#ffd700';
                    } else {
                        s.style.color = '#ddd';
                    }
                });
            });
        });

        document.getElementById('starRatingInput').addEventListener('mouseleave', function() {
            document.querySelectorAll('.star-input').forEach((s, index) => {
                if (index < selectedRating) {
                    s.style.color = '#ffd700';
                } else {
                    s.style.color = '#ddd';
                }
            });
        });

        // Submit review
        function submitReview(event) {
            event.preventDefault();
            
            const rating = document.getElementById('ratingValue').value;
            const title = document.getElementById('reviewTitle').value;
            const text = document.getElementById('reviewText').value;

            if (!rating) {
                alert('Silakan berikan rating terlebih dahulu');
                return;
            }

            // Simulate adding review
            const newReview = {
                id: reviewsData.length + 1,
                name: 'Anda',
                avatar: 'Y',
                rating: parseInt(rating),
                date: 'Baru saja',
                title: title,
                content: text,
                helpful: 0,
                unhelpful: 0,
                isHelpful: null
            };

            reviewsData.unshift(newReview);
            currentReviews = [...reviewsData];
            renderReviews(currentReviews);

            // Close modal and reset form
            closeReviewModal();
            document.getElementById('reviewTitle').value = '';
            document.getElementById('reviewText').value = '';
            selectedRating = 0;

            alert('Review Anda berhasil ditambahkan! Terima kasih atas feedback-nya 🎉');
        }

        // Close modal when clicking outside
        document.getElementById('reviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReviewModal();
            }
        });

        // Initial render
        renderReviews(reviewsData);
    </script>

</body></html>
@endsection