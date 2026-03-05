<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        return view('events.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::with(['creator', 'registrations.user'])->findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function create()
    {
        $this->ensureAdmin();
        return view('events.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'location' => ['nullable', 'string', 'max:255'],
            'max_participants' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', 'in:open,closed'],
        ]);

        $data['created_by'] = auth()->id();

        $event = Event::create($data);

        // ✅ TẠO THÔNG BÁO CHO TẤT CẢ CỰU SINH VIÊN
        $title = 'Sự kiện mới: ' . $event->title;

        $msg = 'Bắt đầu: ' . \Carbon\Carbon::parse($event->start_at)->format('d/m/Y H:i');
        if (!empty($event->location)) $msg .= ' • Địa điểm: ' . $event->location;

        User::where('role', 'cuusinh')
            ->select('id')
            ->chunkById(200, function ($users) use ($title, $msg) {
                $rows = [];
                $now = now();
                foreach ($users as $u) {
                    $rows[] = [
                        'user_id' => $u->id,
                        'title' => $title,
                        'message' => $msg,
                        'type' => 'event',
                        'is_read' => false,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
                if (!empty($rows)) {
                    Notification::insert($rows);
                }
            });

        return redirect()->route('events.index')->with('success', 'Tạo sự kiện thành công!');
    }

    public function edit($id)
    {
        $this->ensureAdmin();

        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $this->ensureAdmin();

        $event = Event::findOrFail($id);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'location' => ['nullable', 'string', 'max:255'],
            'max_participants' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', 'in:open,closed'],
        ]);

        $event->update($data);

        return redirect()->route('events.show', $event->id)->with('success', 'Cập nhật sự kiện thành công!');
    }

    public function destroy($id)
    {
        $this->ensureAdmin();

        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Đã xoá sự kiện!');
    }

    public function toggleStatus($id)
    {
        $this->ensureAdmin();

        $event = Event::findOrFail($id);
        $event->status = $event->status === 'open' ? 'closed' : 'open';
        $event->save();

        return back()->with('success', 'Đã đổi trạng thái sự kiện!');
    }

    private function ensureAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
    }
}