@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - Lowongan Kerja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .filter-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .tab-btn {
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .tab-btn:hover, .tab-btn.active {
            background: #667eea;
            color: white;
        }

        .notification-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex;
            gap: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            position: relative;
        }

        .notification-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .notification-card.unread {
            border-left: 4px solid #667eea;
            background: #f8f9ff;
        }

        .notif-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .icon-application {
            background: #e3f2fd;
            color: #2196f3;
        }

        .icon-interview {
            background: #fff3e0;
            color: #ff9800;
        }

        .icon-accepted {
            background: #e8f5e9;
            color: #4caf50;
        }

        .icon-rejected {
            background: #ffebee;
            color: #f44336;
        }

        .icon-system {
            background: #f3e5f5;
            color: #9c27b0;
        }

        .notif-content {
            flex: 1;
        }

        .notif-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 8px;
        }

        .notif-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .notif-time {
            font-size: 12px;
            color: #999;
        }

        .notif-message {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .notif-company {
            color: #667eea;
            font-weight: 600;
            font-size: 13px;
        }

        .unread-badge {
            width: 10px;
            height: 10px;
            background: #667eea;
            border-radius: 50%;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
        }

        .btn-secondary {
            background: #f0f0f0;
            color: #666;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
        }

        .empty-state {
            background: white;
            padding: 60px 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .empty-state i {
            font-size: 64px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: #666;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #999;
            font-size: 14px;
        }

        .mark-all-read {
            background: white;
            border: none;
            color: #667eea;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
            float: right;
            margin-bottom: 20px;
        }

        .mark-all-read:hover {
            background: #667eea;
            color: white;
        }

        @media (max-width: 768px) {
            .notification-card {
                flex-direction: column;
            }

            .filter-tabs {
                justify-content: center;
            }

            .tab-btn {
                font-size: 12px;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-bell"></i> Notifikasi</h1>
            <p>Pantau semua update lowongan kerja dan lamaran Anda</p>
        </div>

        <button class="mark-all-read" onclick="markAllAsRead()">
            <i class="fas fa-check-double"></i> Tandai Semua Dibaca
        </button>

        <div class="filter-tabs">
            <button class="tab-btn active" onclick="filterNotifications('all')">Semua</button>
            <button class="tab-btn" onclick="filterNotifications('application')">Lamaran</button>
            <button class="tab-btn" onclick="filterNotifications('interview')">Interview</button>
            <button class="tab-btn" onclick="filterNotifications('result')">Hasil</button>
            <button class="tab-btn" onclick="filterNotifications('system')">Sistem</button>
        </div>

        <div id="notifications-container"></div>
    </div>

    <script>
        // Data notifikasi simulasi
        const notificationsData = [
            {
                id: 1,
                type: 'interview',
                title: 'Undangan Interview',
                message: 'Selamat! Anda diundang untuk interview posisi Frontend Developer pada tanggal 15 November 2025 pukul 10.00 WIB.',
                company: 'PT Tech Indonesia',
                time: '2 jam yang lalu',
                unread: true,
                icon: 'fas fa-video'
            },
            {
                id: 2,
                type: 'application',
                title: 'Lamaran Diterima',
                message: 'Lamaran Anda untuk posisi UI/UX Designer telah diterima dan sedang dalam proses review oleh HRD.',
                company: 'PT Digital Creative',
                time: '5 jam yang lalu',
                unread: true,
                icon: 'fas fa-file-alt'
            },
            {
                id: 3,
                type: 'result',
                title: 'Selamat! Anda Diterima',
                message: 'Kami dengan senang hati menginformasikan bahwa Anda diterima untuk posisi Backend Developer di perusahaan kami.',
                company: 'PT Solusi Digital',
                time: '1 hari yang lalu',
                unread: true,
                icon: 'fas fa-check-circle'
            },
            {
                id: 4,
                type: 'system',
                title: 'Lowongan Baru Sesuai Profil Anda',
                message: 'Ada 5 lowongan baru yang sesuai dengan profil dan keahlian Anda. Lihat sekarang!',
                company: 'Sistem',
                time: '2 hari yang lalu',
                unread: false,
                icon: 'fas fa-briefcase'
            },
            {
                id: 5,
                type: 'application',
                title: 'Lamaran Sedang Diproses',
                message: 'Lamaran Anda untuk posisi Full Stack Developer sedang dalam tahap screening.',
                company: 'PT Inovasi Teknologi',
                time: '3 hari yang lalu',
                unread: false,
                icon: 'fas fa-spinner'
            },
            {
                id: 6,
                type: 'result',
                title: 'Pemberitahuan Hasil',
                message: 'Terima kasih atas partisipasi Anda. Mohon maaf, untuk saat ini posisi yang Anda lamar sudah terisi.',
                company: 'PT Global Tech',
                time: '4 hari yang lalu',
                unread: false,
                icon: 'fas fa-info-circle'
            },
            {
                id: 7,
                type: 'interview',
                title: 'Pengingat Interview',
                message: 'Interview Anda untuk posisi Data Analyst dijadwalkan besok pukul 14.00 WIB. Pastikan Anda sudah siap!',
                company: 'PT Data Solutions',
                time: '5 hari yang lalu',
                unread: false,
                icon: 'fas fa-calendar-check'
            },
            {
                id: 8,
                type: 'system',
                title: 'Lengkapi Profil Anda',
                message: 'Profil Anda masih 65% lengkap. Lengkapi profil untuk meningkatkan peluang diterima kerja.',
                company: 'Sistem',
                time: '1 minggu yang lalu',
                unread: false,
                icon: 'fas fa-user-edit'
            }
        ];

        let notifications = [...notificationsData];
        let currentFilter = 'all';

        function getIconClass(type) {
            switch(type) {
                case 'application': return 'icon-application';
                case 'interview': return 'icon-interview';
                case 'result':
                    // Perlu sedikit modifikasi logika karena 'notifications' tidak terdefinisi di scope ini
                    // Kita cari di data utama saja
                    const relatedNotif = notificationsData.find(n => n.type === type);
                    return relatedNotif && relatedNotif.title.includes('Diterima') ? 'icon-accepted' : 'icon-rejected';
                case 'system': return 'icon-system';
                default: return 'icon-application';
            }
        }

        function renderNotifications(filter = 'all') {
            const container = document.getElementById('notifications-container');
            let filteredNotifications = notifications;

            if (filter !== 'all') {
                if(filter === 'result') {
                     filteredNotifications = notifications.filter(n => n.type === 'result');
                } else {
                     filteredNotifications = notifications.filter(n => n.type === filter);
                }
            }

            if (filteredNotifications.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-bell-slash"></i>
                        <h3>Tidak Ada Notifikasi</h3>
                        <p>Anda belum memiliki notifikasi untuk kategori ini</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = filteredNotifications.map(notif => `
                <div class="notification-card ${notif.unread ? 'unread' : ''}" onclick="markAsRead(${notif.id})">
                    ${notif.unread ? '<div class="unread-badge"></div>' : ''}
                    <div class="notif-icon ${getIconClass(notif.type)}">
                        <i class="${notif.icon}"></i>
                    </div>
                    <div class="notif-content">
                        <div class="notif-header">
                            <div>
                                <div class="notif-title">${notif.title}</div>
                                <div class="notif-company">${notif.company}</div>
                            </div>
                            <div class="notif-time">
                                <i class="far fa-clock"></i> ${notif.time}
                            </div>
                        </div>
                        <div class="notif-message">${notif.message}</div>
                        ${notif.type === 'interview' ? `
                            <div class="actions">
                                <button class="btn btn-primary" onclick="handleAction(event, 'accept', ${notif.id})">
                                    <i class="fas fa-check"></i> Konfirmasi Hadir
                                </button>
                                <button class="btn btn-secondary" onclick="handleAction(event, 'decline', ${notif.id})">
                                    <i class="fas fa-times"></i> Tidak Bisa Hadir
                                </button>
                            </div>
                        ` : notif.type === 'result' && notif.title.includes('Diterima') ? `
                            <div class="actions">
                                <button class="btn btn-primary" onclick="handleAction(event, 'view', ${notif.id})">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </button>
                            </div>
                        ` : ''}
                    </div>
                </div>
            `).join('');
        }

        function filterNotifications(type) {
            currentFilter = type;

            // Update active tab
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            // 'event' tidak terdefinisi di sini jika dipanggil dari HTML, jadi kita perlu mendapatkannya
            const currentBtn = event.target;
            currentBtn.classList.add('active');

            renderNotifications(type);
        }

        function markAsRead(id) {
            const notif = notifications.find(n => n.id === id);
            if (notif) {
                notif.unread = false;
                renderNotifications(currentFilter);
            }
        }

        function markAllAsRead() {
            notifications.forEach(n => n.unread = false);
            renderNotifications(currentFilter);
            alert('Semua notifikasi telah ditandai sebagai dibaca');
        }

        function handleAction(event, action, id) {
            event.stopPropagation();

            const messages = {
                accept: 'Konfirmasi kehadiran berhasil dikirim!',
                decline: 'Pemberitahuan ketidakhadiran telah dikirim.',
                view: 'Membuka detail...'
            };

            alert(messages[action] || 'Aksi berhasil');
            markAsRead(id);
        }

        // Initial render
        document.addEventListener('DOMContentLoaded', () => {
            renderNotifications();
        });
    </script>
</body>
</html>
@endsection
