<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Notification;

class RegistrationController extends Controller
{
    public function store($id)
    {
        $user = auth()->user();
        $event = Event::findOrFail($id);

        if ($event->status !== 'open') {
            return back()->with('error', 'Sự kiện đang đóng đăng ký.');
        }

        $registeredCount = Registration::where('event_id', $event->id)
            ->where('status', 'registered')
            ->count();

        if (!is_null($event->max_participants) && $registeredCount >= $event->max_participants) {
            return back()->with('error', 'Sự kiện đã đủ số lượng.');
        }

        $existing = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if ($existing && $existing->status === 'registered') {
            return back()->with('error', 'Bạn đã đăng ký sự kiện này rồi.');
        }

        if ($existing && $existing->status === 'cancelled') {
            $existing->update(['status' => 'registered']);
        } else {
            Registration::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'status' => 'registered',
            ]);
        }

        Notification::create([
            'user_id' => $user->id,
            'title' => 'Đăng ký sự kiện thành công',
            'message' => "Bạn đã đăng ký tham gia: {$event->title}",
            'type' => 'registration',
            'is_read' => false,
        ]);

        return back()->with('success', 'Đăng ký thành công!');
    }

    public function cancel($id)
    {
        $user = auth()->user();
        $event = Event::findOrFail($id);

        $reg = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if (!$reg || $reg->status !== 'registered') {
            return back()->with('error', 'Bạn chưa đăng ký sự kiện này.');
        }

        $reg->update(['status' => 'cancelled']);

        Notification::create([
            'user_id' => $user->id,
            'title' => 'Hủy đăng ký sự kiện',
            'message' => "Bạn đã hủy đăng ký: {$event->title}",
            'type' => 'registration',
            'is_read' => false,
        ]);

        return back()->with('success', 'Đã hủy đăng ký!');
    }
}