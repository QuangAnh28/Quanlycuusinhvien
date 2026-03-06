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
        $this->ensureManager();
        return view('events.create');
    }

    public function store(Request $request)
    {
        $this->ensureManager();

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

        $title = 'Sự kiện mới: ' . $event->title;

        $message = 'Bắt đầu: ' . \Carbon\Carbon::parse($event->start_at)->format('d/m/Y H:i');
        if (!empty($event->location)) {
            $message .= ' • Địa điểm: ' . $event->location;
        }

        $receivers = User::where('role', 'cuusinh')->get();

        foreach ($receivers as $user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => $title,
                'message' => $message,
                'type' => 'event',
                'is_read' => false,
            ]);
        }

        return redirect()->route('events.index')->with('success', 'Tạo sự kiện thành công!');
    }

    public function edit($id)
    {
        $this->ensureManager();

        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $this->ensureManager();

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
        $this->ensureManager();

        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Đã xoá sự kiện!');
    }

    public function toggleStatus($id)
    {
        $this->ensureManager();

        $event = Event::findOrFail($id);
        $event->status = $event->status === 'open' ? 'closed' : 'open';
        $event->save();

        return back()->with('success', 'Đã đổi trạng thái sự kiện!');
    }

    private function ensureManager(): void
    {
        abort_unless(
            auth()->check() && in_array(auth()->user()->role, ['admin', 'canbokhoa']),
            403
        );
    }
}