@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    
    {{-- Main Content --}}
    <main class=" p-8 bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Welcome, {{ auth()->user()->name }} (Admin)</h1>
        <p class="text-gray-700">Use the sidebar to manage your site.</p>
    </main>

@endsection
