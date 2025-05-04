@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

@if(session('success'))
    <div class="text-green-500">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.createStaff') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label>Name</label>
        <input type="text" name="name" class="border p-2 w-full" required>
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" class="border p-2 w-full" required>
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password" class="border p-2 w-full" required>
    </div>

    <button type="submit" class="bg-gray-800 text-white px-4 py-2">Create Staff</button>
</form>

@endsection