<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display all notifications for the authenticated user
     */
    public function index(Request $request)
    {
        $query = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc');

        // Filter berdasarkan status baca
        if ($request->filter === 'unread') {
            $query->unread();
        } elseif ($request->filter === 'read') {
            $query->read();
        }

        // Filter berdasarkan tipe
        if ($request->type) {
            if ($request->type === 'lamaran') {
                $query->where('type', 'lamaran_baru');
            } elseif ($request->type === 'status') {
                $query->where('type', 'like', 'status_%');
            }
        }

        $notifications = $query->paginate(15);
        $unreadCount = Notification::where('user_id', auth()->id())->unread()->count();
        $totalCount = Notification::where('user_id', auth()->id())->count();

        return view('page.notification.index', compact('notifications', 'unreadCount', 'totalCount'));
    }

    /**
     * Get unread notification count (for AJAX/badge)
     */
    public function unreadCount()
    {
        $count = Notification::where('user_id', auth()->id())
            ->unread()
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Get latest notifications (for dropdown)
     */
    public function latest()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $unreadCount = Notification::where('user_id', auth()->id())
            ->unread()
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Notification $notification)
    {
        // Pastikan notification milik user yang login
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->markAsRead();

        // Jika request AJAX, return JSON
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        // Redirect ke link notification jika ada
        if ($notification->link) {
            return redirect($notification->link);
        }

        return back();
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->id())
            ->unread()
            ->update(['read_at' => now()]);

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }

    /**
     * Delete a notification
     */
    public function destroy(Notification $notification)
    {
        // Pastikan notification milik user yang login
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    /**
     * Delete all notifications
     */
    public function destroyAll()
    {
        Notification::where('user_id', auth()->id())->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Semua notifikasi berhasil dihapus.');
    }
}
