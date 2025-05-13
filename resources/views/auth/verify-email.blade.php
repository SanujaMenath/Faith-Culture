<!-- resources/views/auth/verify-email.blade.php -->
@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="min-h-80 flex items-center justify-center bg-white">
    <div class="max-w-md w-full bg-white p-8 shadow-xl rounded-xl border border-gray-200">
        <h2 class="text-xl font-semibold mb-4">Email Verification Required</h2>
        <p class="mb-4 text-gray-600">
            Please verify your email address by clicking the link we sent to your inbox.
        </p>
        @if (session('status') == 'verification-link-sent')
            <div class="bg-green-100 text-green-800 p-2 rounded-md mb-4">
                A new verification link has been sent to your email.
            </div>
        @endif
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                Resend Verification Email
            </button>
        </form>
    </div>
</div>
@endsection
