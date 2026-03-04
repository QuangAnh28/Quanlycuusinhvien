<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StatsController extends Controller
{
    public function index()
    {
        // 1) Số lượng cựu sinh viên đã đăng ký tài khoản
        // (giả định user có cột role = 'cuusinh')
        $totalAlumniAccounts = DB::table('users')
            ->where('role', 'cuusinh')
            ->count();

        // 2) Số lượng sự kiện đã diễn ra
        // cố gắng tìm cột thời gian kết thúc phổ biến
        $now = now();

        $eventsOccurredQuery = DB::table('events');

        if (Schema::hasColumn('events', 'end_time')) {
            $eventsOccurredQuery->where('end_time', '<', $now);
        } elseif (Schema::hasColumn('events', 'end_at')) {
            $eventsOccurredQuery->where('end_at', '<', $now);
        } elseif (Schema::hasColumn('events', 'to_date')) {
            $eventsOccurredQuery->where('to_date', '<', $now);
        } elseif (Schema::hasColumn('events', 'end_date')) {
            $eventsOccurredQuery->where('end_date', '<', $now);
        } elseif (Schema::hasColumn('events', 'start_time')) {
            // nếu không có cột kết thúc thì lấy tạm start_time < now
            $eventsOccurredQuery->where('start_time', '<', $now);
        }

        $totalEventsOccurred = $eventsOccurredQuery->count();

        // 3) Tổng lượt đăng ký tham gia
        // (giả định bảng registrations)
        $totalRegistrations = Schema::hasTable('registrations')
            ? DB::table('registrations')->count()
            : 0;

        return view('stats.index', compact(
            'totalAlumniAccounts',
            'totalEventsOccurred',
            'totalRegistrations'
        ));
    }
}