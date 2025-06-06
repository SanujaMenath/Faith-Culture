@extends('layouts.admin')

@section('title', 'Profile - Faith Culture')

@section('content')
<div class="min-h-96 max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Profile</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
   
    <div class="bg-white shadow rounded-lg p-6">
        @if($editMode)
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="mt-1 w-full border-gray-300 rounded p-2">
                        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}" class="mt-1 w-full border-gray-300 rounded p-2">
                        @error('address') <p class="text-red-500 text-sm">error</p> @enderror
                    </div>
                </div>

                <div class="mt-6 flex gap-4">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500">
                        Save Changes
                    </button>
                    <a href="{{ route('admin.profile') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-400">
                        Cancel
                    </a>
                </div>
            </form>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <p class="mt-1 text-lg text-gray-900">{{ Auth::user()->name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <p class="mt-1 text-lg text-gray-900">{{ Auth::user()->address }}</p>
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
                <a href="{{ route('admin.profile', ['edit' => 'true']) }}" class="inline-block bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                    <i class="fas fa-cog mr-2"></i> Edit Profile
                </a>
            </div>
        @endif
    </div>
</div>
@endsection