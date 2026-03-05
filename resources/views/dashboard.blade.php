@extends('layouts.dashboard')

@section('title','Tổng quan')

@section('content')
  <div style="background:rgba(255,255,255,.93); border:1px solid rgba(20,50,130,.08); border-radius:16px; box-shadow:0 10px 26px rgba(10,24,60,.10); padding:18px;">
    <h2 style="margin:0 0 10px; font-weight:900;">Xin chào, {{ auth()->user()->name }}</h2>
    <p style="margin:0; opacity:.75;">Đây là trang tổng quan.</p>
  </div>
@endsection