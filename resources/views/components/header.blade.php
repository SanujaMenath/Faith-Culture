<header class="fixed top-0 left-0 right-0 w-full bg-white shadow-md py-4 z-50">
  <div class="container mx-auto px-3 flex items-center justify-between">
    <!-- Logo on the left -->
    <a href="/" class="text-2xl font-bold text-gray-900 flex items-center gap-2 group relative">
      <img src="{{ asset('storage/images/logo.jpg') }}" alt="Faith Culture Logo" class="h-10">
      <div>FAITH CULTURE</div>
      <span class="absolute left-0 bottom-0 w-full h-0.5 bg-black scale-x-0 group-hover:scale-x-100 transition-transform origin-right group-hover:origin-left"></span>
    </a>

    <!-- Middle Navigation -->
    <nav class="hidden md:flex items-center justify-center gap-3 mx-auto">
      <a href="/"
        class="relative px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all overflow-hidden group hover:text-white hover:border-gray-900">
        <span
          class="absolute inset-0 bg-gray-700 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-right group-hover:origin-left z-0"></span>
        <span class="relative z-10">Home</span>
      </a>
      <a href="/shop"
        class="relative px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all overflow-hidden group hover:text-white hover:border-gray-900">
        <span
          class="absolute inset-0 bg-gray-700 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-right group-hover:origin-left z-0"></span>
        <span class="relative z-10">Shop</span>
      </a>
      <a href="/orders"
        class="relative px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all overflow-hidden group hover:text-white hover:border-gray-900">
        <span
          class="absolute inset-0 bg-gray-700 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-right group-hover:origin-left z-0"></span>
        <span class="relative z-10">Orders</span>
      </a>
      <a href="/"
        class="relative px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all overflow-hidden group hover:text-white hover:border-gray-900">
        <span
          class="absolute inset-0 bg-gray-700 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-right group-hover:origin-left z-0"></span>
        <span class="relative z-10">About Us</span>
      </a>
    </nav>

    <!-- Right side icons and profile -->
    <div class="flex items-center gap-4">
      <a href="" class="relative px-2 py-2">
        <i class="fa-solid fa-magnifying-glass text-gray-700 hover:text-black transition-colors"></i>
      </a>
      <a href="/cart" class="relative px-2 py-2">
        <i class="fa-solid fa-cart-plus text-gray-700 hover:text-black transition-colors"></i>
      </a>

      <!-- Profile Button with Dropdown -->
      <div class="relative" x-data="{ open: false }">
        @auth
          <button @click="open = !open" @click.away="open = false"
            class="flex items-center px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all hover:bg-gray-200 focus:outline-none">
            <i class="fa-regular fa-circle-user mr-2"></i>
            <i class="fas fa-chevron-down ml-2 text-xs"></i>
          </button>

          <!-- Dropdown Menu -->
          <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
            <a href="/admin/profile" class="block px-3 py-1 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fa-solid fa-circle-user mr-2"></i> Profile
            </a>
            <a href="/settings" class="block px-3 py-1 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fas fa-cog mr-2"></i> Settings
            </a>
            <div class="border-t border-gray-100"></div>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="block w-full text-left px-3 py-1 text-sm text-gray-700 hover:bg-gray-100">
                <i class="fas fa-sign-out-alt mr-2"></i> Log out
              </button>
            </form>
          </div>
        @else
          <a href="/login"
            class="flex items-center px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all overflow-hidden group hover:text-white hover:border-gray-900">
            <span
              class="absolute inset-0 bg-gray-700 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-right group-hover:origin-left z-0"></span>
            <span class="relative z-10"><i class="fas fa-user mr-2"></i> Login</span>
          </a>
        @endauth
      </div>
    </div>
  </div>
  
  <!-- Mobile Navigation Menu Button - Only visible on small screens -->
  <div class="md:hidden mt-2 flex justify-center">
    <button class="px-2 py-1 text-gray-700 hover:text-black focus:outline-none" x-data="{ open: false }" @click="open = !open">
      <i class="fas fa-bars text-lg"></i>
      
      <!-- Mobile Menu (Hidden by default) -->
      <div x-show="open" @click.away="open = false" class="absolute left-0 right-0 bg-white shadow-md mt-2 py-2 z-40">
        <a href="/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Home</a>
        <a href="/shop" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Shop</a>
        <a href="/orders" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Orders</a>
        <a href="/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">About Us</a>
      </div>
    </button>
  </div>
</header>

<!-- Adding padding to the top of the body to prevent content from being hidden behind the fixed header -->
<div class="pt-24">
  <!-- Your page content starts here -->
</div>