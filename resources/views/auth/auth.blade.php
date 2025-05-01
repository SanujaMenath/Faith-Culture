@extends('layouts.app')

@section('title', 'Login or Register')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white">
    <div class="w-full max-w-md p-8 bg-white shadow-2xl rounded-xl border border-gray-300">
        <div class="flex justify-around mb-6 border-b border-gray-300">
            <button id="show-login" class="font-bold text-black py-2 border-b-2 border-black">Sign In</button>
            <button id="show-register" class="font-bold text-gray-500 py-2 hover:text-black">Sign Up</button>
        </div>

        {{-- Sign In Form --}}
        <form id="login-form" action="{}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium text-lg text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:border-black" />
            </div>
            <div>
                <label class="block font-medium text-lg text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:border-black" />
            </div>
            <button type="submit" class="w-full bg-black text-white py-2 rounded-3xl hover:bg-gray-800">Sign In</button>
        </form>

        {{-- Sign Up Form --}}
        <form id="register-form" action="{}" method="POST" class="space-y-4 hidden">
            @csrf
            <div>
                <label class="block font-bold text-gray-700">Name</label>
                <input type="text" name="name" required class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:border-black" />
            </div>
            <div>
                <label class="block font-bold text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:border-black" />
            </div>
            <div>
                <label class="block font-bold text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:border-black" />
            </div>
            <div>
                <label class="block font-bold text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:border-black" />
            </div>
            <button type="submit" class="w-full bg-black text-white py-2 rounded-3xl hover:bg-gray-800">Sign Up</button>
        </form>
    </div>
</div>

<script>
    const loginBtn = document.getElementById('show-login');
    const registerBtn = document.getElementById('show-register');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');

    loginBtn.addEventListener('click', () => {
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
        loginBtn.classList.add('text-black', 'border-black', 'border-b-2', 'font-semibold');
        registerBtn.classList.remove('text-black', 'border-black', 'border-b-2', 'font-semibold');
        registerBtn.classList.add('text-gray-500');
    });

    registerBtn.addEventListener('click', () => {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
        registerBtn.classList.add('text-black', 'border-black', 'border-b-2', 'font-semibold');
        loginBtn.classList.remove('text-black', 'border-black', 'border-b-2', 'font-semibold');
        loginBtn.classList.add('text-gray-500');
    });
</script>
@endsection
