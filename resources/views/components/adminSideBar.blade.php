 <aside class="w-64 bg-gray-900 text-white p-6">
        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
        <nav class="space-y-3">
            <a href="{{ route('admin.profile') }}" class="block hover:text-yellow-300">Edit Bio & Password</a>
            <a href="{{ route('admin.staffs') }}" class="block hover:text-yellow-300">Create Staff</a>
            <a href="{{ route('admin.editHomepage') }}" class="block hover:text-yellow-300">Edit Homepage</a>
            <a href="{{ route('admin.addCategory') }}" class="block hover:text-yellow-300">Add Category</a>
            <a href="{{ route('admin.addProducts') }}" class="block hover:text-yellow-300">Add Products</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-6 text-red-400 hover:text-red-600">Logout</button>
            </form>
        </nav>
    </aside>