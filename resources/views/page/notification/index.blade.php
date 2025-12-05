@extends('layout.main')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .notification-container {
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

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
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

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .header-actions button {
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-mark-all {
        background: #667eea;
        color: white;
    }

    .btn-mark-all:hover {
        background: #5568d3;
    }

    .btn-delete-all {
        background: #ff6b6b;
        color: white;
    }

    .btn-delete-all:hover {
        background: #ee5a52;
    }

    .stats-bar {
        display: flex;
        gap: 20px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #666;
    }

    .stat-badge {
        background: #667eea;
        color: white;
        padding: 2px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .stat-badge.unread {
        background: #ff6b6b;
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
        text-decoration: none;
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
        font-size: 20px;
        flex-shrink: 0;
    }

    .icon-blue {
        background: #e3f2fd;
        color: #2196f3;
    }

    .icon-green {
        background: #e8f5e9;
        color: #4caf50;
    }

    .icon-red {
        background: #ffebee;
        color: #f44336;
    }

    .icon-yellow {
        background: #fff3e0;
        color: #ff9800;
    }

    .icon-purple {
        background: #f3e5f5;
        color: #9c27b0;
    }

    .icon-orange {
        background: #fff3e0;
        color: #ff5722;
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
        white-space: nowrap;
    }

    .notif-message {
        color: #666;
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 10px;
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

    .notif-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .notif-actions button, .notif-actions a {
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-view {
        background: #667eea;
        color: white;
    }

    .btn-view:hover {
        background: #5568d3;
    }

    .btn-read {
        background: #e8f5e9;
        color: #4caf50;
    }

    .btn-read:hover {
        background: #c8e6c9;
    }

    .btn-delete {
        background: #ffebee;
        color: #f44336;
    }

    .btn-delete:hover {
        background: #ffcdd2;
    }

    .empty-state {
        background: white;
        padding: 60px 30px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .empty-state i {
        font-size: 80px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #333;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #666;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination-wrapper nav {
        background: white;
        padding: 15px 25px;
        border-radius: 10px;
    }

    /* Alert Messages */
    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @media (max-width: 768px) {
        .header-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .notification-card {
            flex-direction: column;
        }

        .notif-header {
            flex-direction: column;
            gap: 5px;
        }
    }
</style>

<div class="notification-container">
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-top">
                <div>
                    <h1><i class="fas fa-bell"></i> Notifikasi</h1>
                    <p>Kelola semua notifikasi Anda di sini</p>
                </div>
                @if($totalCount > 0)
                <div class="header-actions">
                    @if($unreadCount > 0)
                    <form action="{{ route('notifications.mark-all-read') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-mark-all">
                            <i class="fas fa-check-double"></i> Tandai Semua Dibaca
                        </button>
                    </form>
                    @endif
                    <form action="{{ route('notifications.destroy-all') }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus semua notifikasi?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete-all">
                            <i class="fas fa-trash"></i> Hapus Semua
                        </button>
                    </form>
                </div>
                @endif
            </div>
            <div class="stats-bar">
                <div class="stat-item">
                    <span>Total:</span>
                    <span class="stat-badge">{{ $totalCount }}</span>
                </div>
                <div class="stat-item">
                    <span>Belum Dibaca:</span>
                    <span class="stat-badge unread">{{ $unreadCount }}</span>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
        @endif

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <a href="{{ route('notifications.index') }}" class="tab-btn {{ !request('filter') && !request('type') ? 'active' : '' }}">
                Semua
            </a>
            <a href="{{ route('notifications.index', ['filter' => 'unread']) }}" class="tab-btn {{ request('filter') === 'unread' ? 'active' : '' }}">
                Belum Dibaca
            </a>
            <a href="{{ route('notifications.index', ['filter' => 'read']) }}" class="tab-btn {{ request('filter') === 'read' ? 'active' : '' }}">
                Sudah Dibaca
            </a>
            <a href="{{ route('notifications.index', ['type' => 'lamaran']) }}" class="tab-btn {{ request('type') === 'lamaran' ? 'active' : '' }}">
                Lamaran Baru
            </a>
            <a href="{{ route('notifications.index', ['type' => 'status']) }}" class="tab-btn {{ request('type') === 'status' ? 'active' : '' }}">
                Status Update
            </a>
        </div>

        <!-- Notification List -->
        @forelse($notifications as $notification)
        <div class="notification-card {{ !$notification->isRead() ? 'unread' : '' }}">
            @if(!$notification->isRead())
            <div class="unread-badge"></div>
            @endif

            <div class="notif-icon icon-{{ $notification->color }}">
                <i class="fas {{ $notification->icon_class }}"></i>
            </div>

            <div class="notif-content">
                <div class="notif-header">
                    <div class="notif-title">{{ $notification->title }}</div>
                    <div class="notif-time">{{ $notification->time_ago }}</div>
                </div>
                <div class="notif-message">{{ $notification->message }}</div>

                <div class="notif-actions">
                    @if($notification->link)
                    <form action="{{ route('notifications.read', $notification) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-view">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </button>
                    </form>
                    @endif

                    @if(!$notification->isRead())
                    <form action="{{ route('notifications.read', $notification) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-read">
                            <i class="fas fa-check"></i> Tandai Dibaca
                        </button>
                    </form>
                    @endif

                    <form action="{{ route('notifications.destroy', $notification) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fas fa-bell-slash"></i>
            <h3>Tidak ada notifikasi</h3>
            <p>Anda belum memiliki notifikasi saat ini.</p>
        </div>
        @endforelse

        <!-- Pagination -->
        @if($notifications->hasPages())
        <div class="pagination-wrapper">
            {{ $notifications->links() }}
        </div>
        @endif
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
