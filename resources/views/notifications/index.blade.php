@extends('layouts.dashboard')

@section('title','Thông báo')

@section('content')

<h2 style="margin-bottom:20px;font-weight:900;">Thông báo của bạn</h2>

@if($notifications->count() == 0)
    <p>Chưa có thông báo.</p>
@else
    <div style="display:flex;flex-direction:column;gap:12px;">
        @foreach($notifications as $noti)
            <div style="background:white;padding:14px;border-radius:10px;border:1px solid #ddd;">
                <strong>{{ $noti->title }}</strong>
                <div style="opacity:.8;margin-top:4px;">
                    {{ $noti->message }}
                </div>
                <div style="font-size:12px;opacity:.6;margin-top:6px;">
                    {{ $noti->created_at->format('d/m/Y H:i') }}
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection