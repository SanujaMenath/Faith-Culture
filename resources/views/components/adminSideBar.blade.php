 <aside class="w-64 bg-gray-900 text-white p-6">
        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
        <nav class="space-y-3">
            <a href="{{ route('admin.profile') }}" class="block hover:text-yellow-300">Edit Bio & Password</a>
            <a href="{{ route('admin.staffs') }}" class="block hover:text-yellow-300">Create Staff</a>
            <a href="{{ route('admin.editHomepage') }}" class="block hover:text-yellow-300">Edit Homepage</a>
            <a href="{{ route('admin.addCategory') }}" class="block hover:text-yellow-300">Manage Category</a>
            <a href="{{ route('admin.addProducts') }}" class="block hover:text-yellow-300">Manage Products</a>
            <a href="{{ route('admin.manageSizes') }}" class="block hover:text-yellow-300">Manage Sizes</a>
            <a href="{{ route('admin.manageColors') }}" class="block hover:text-yellow-300">Manage Colors</a>
            <a href="{{ route('admin.inventory') }}" class="block hover:text-yellow-300">Manage Inventory</a>
            <a href="{{route('logout')}}" class="mt-6 text-red-400 hover:text-red-600">Logout</a>
        </nav>
    </aside>