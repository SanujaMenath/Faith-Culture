@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen flex">
    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-white p-6">
        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
        <nav class="space-y-3">
            <a href="{{ route('admin.profile') }}" class="block hover:text-yellow-300">Edit Bio & Password</a>
            <a href="{{ route('admin.staffs') }}" class="block hover:text-yellow-300">Manage Staff</a>
            <a href="{{ route('admin.editHomepage') }}" class="block hover:text-yellow-300">Edit Homepage</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-6 text-red-400 hover:text-red-600">Logout</button>
            </form>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8 bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Welcome, {{ auth()->user()->name }} (Admin)</h1>
        <p class="text-gray-700">Use the sidebar to manage your site.</p>
    </main>
</div>
@endsection
