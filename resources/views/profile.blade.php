@extends('layouts.app')

@section('title', 'Profile - Faith Culture')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Profile</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <p class="mt-1 text-lg text-gray-900">{{ Auth::user()->name }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">First Name</label>
                <p class="mt-1 text-lg text-gray-900">{{ explode(' ', Auth::user()->name) }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <p class="mt-1 text-lg text-gray-900">{{ Auth::user()->email }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Joined On</label>
                <p class="mt-1 text-lg text-gray-900">{{ Auth::user()->created_at->format('F j, Y') }}</p>
            </div>
        </div>

        <div class="mt-8">
            <a href="/settings" class="inline-block bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                <i class="fas fa-cog mr-2"></i> Edit Profile
            </a>
        </div>
    </div>
</div>
@endsection
