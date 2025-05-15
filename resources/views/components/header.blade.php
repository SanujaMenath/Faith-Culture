<header class="fixed top-0 left-0 right-0 w-full py-2 bg-white shadow-2xl z-50">
  <!-- Desktop and Large Screen Layout -->
  <div class="mx-auto lg:mx-8 px-4">
    <!-- Desktop Layout (hidden on mobile) -->
    <div class="hidden md:flex items-center justify-between">
      <!-- Logo and Brand Name (Left) -->
      <a href="/" class="text-2xl font-bold text-gray-900 flex items-center gap-2 group relative">
        <img src="{{ asset('storage/images/logo.jpg') }}" alt="FAITH CULTURE Logo" class="h-16 w-auto">
        <div>FAITH CULTURE</div>
        <span
          class="absolute left-0 bottom-0 w-full h-0.5 bg-black scale-x-0 group-hover:scale-x-100 transition-transform origin-right group-hover:origin-left"></span>
      </a>

      <!-- Navigation Links (Center) -->
      <nav class="flex items-center justify-center gap-3">
        <a href="/"
          class="relative px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all overflow-hidden group hover:text-white hover:border-gray-900 {{ request()->is('/') ? 'active border-gray-900 bg-gray-700 text-white' : '' }}">
          <span
            class="absolute inset-0 bg-gray-700 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-right group-hover:origin-left z-0 {{ request()->is('/') ? 'scale-x-100' : '' }}"></span>
          <span class="relative z-10">Home</span>
        </a>
        <a href="/shop"
          class="relative px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all overflow-hidden group hover:text-white hover:border-gray-900 {{ request()->is('shop*') ? 'active border-gray-900 bg-gray-700 text-white' : '' }}">
          <span
            class="absolute inset-0 bg-gray-700 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-right group-hover:origin-left z-0 {{ request()->is('shop*') ? 'scale-x-100' : '' }}"></span>
          <span class="relative z-10">Shop</span>
        </a>
        <a href="/view-orders"
          class="relative px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all overflow-hidden group hover:text-white hover:border-gray-900 {{ request()->is('view-orders*') ? 'active border-gray-900 bg-gray-700 text-white' : '' }}">
          <span
            class="absolute inset-0 bg-gray-700 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-right group-hover:origin-left z-0 {{ request()->is('view-orders*') ? 'scale-x-100' : '' }}"></span>
          <span class="relative z-10">Orders</span>
        </a>
        <a href="/about"
          class="relative px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all overflow-hidden group hover:text-white hover:border-gray-900 {{ request()->is('about*') ? 'active border-gray-900 bg-gray-700 text-white' : '' }}">
          <span
            class="absolute inset-0 bg-gray-700 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-right group-hover:origin-left z-0 {{ request()->is('about*') ? 'scale-x-100' : '' }}"></span>
          <span class="relative z-10">About Us</span>
        </a>
      </nav>

      <!-- Right Icons (Cart and Profile) -->
      <div class="flex items-center gap-4">
        <a href="/cart" class="relative px-1 py-2">
          <i class="fa-solid fa-search text-gray-700 hover:text-black transition-colors"></i>
        </a>
        <a href="/cart" class="relative px-1 py-2">
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
            <a href="/select-profile" class="block px-3 py-1 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fa-solid fa-circle-user mr-2"></i> Profile
            </a>
            <a href="/settings" class="block px-3 py-1 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fas fa-cog mr-2"></i> Settings
            </a>
            <div class="border-t border-gray-100"></div>
            <a href="/logout" class="block w-full text-left px-3 py-1 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fas fa-sign-out-alt mr-2"></i> Log out
            </a>
          </div>
          @else
          <a href="/login"
            class="flex items-center px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all overflow-hidden group hover:text-white hover:border-gray-900">
            <span
              class="absolute inset-0 bg-gray-700 rounded-lg scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-right group-hover:origin-left z-0"></span>
            <span class="relative z-10"><i class="fas fa-user mr-2"></i> Login</span>
          </a>
          @endauth
        </div>
      </div>
    </div>

    <!-- Mobile Layout -->
    <div class="md:hidden flex items-center justify-between">
      <!-- Hamburger Menu (Left) -->
      <button class="px-2 py-1 text-gray-700 hover:text-black focus:outline-none" id="mobile-menu-button" aria-label="Menu">
        <i class="fas fa-bars text-lg"></i>
      </button>

      <!-- Logo and Brand Name (Center) -->
      <a href="/" class="text-xl font-bold text-gray-900 flex items-center gap-2">
        <img src="{{ asset('storage/images/logo.jpg') }}" alt="FAITH CULTURE Logo" class="h-12 w-auto">
        <div>FAITH CULTURE</div>
      </a>

      <!-- Right side icons (Same as desktop) -->
      <div class="flex items-center gap-3">
        <a href="/cart" class="relative px-2 py-2">
          <i class="fa-solid fa-cart-plus text-gray-700 hover:text-black transition-colors"></i>
        </a>
        
        <!-- Mobile Profile Icon -->
        <div class="relative" x-data="{ profileOpen: false }">
          @auth
          <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" class="px-2 py-1">
            <i class="fa-regular fa-circle-user text-gray-700 hover:text-black transition-colors"></i>
          </button>
          
          <!-- Profile Dropdown Menu -->
          <div x-show="profileOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
            <a href="/select-profile" class="block px-3 py-1 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fa-solid fa-circle-user mr-2"></i> Profile
            </a>
            <a href="/settings" class="block px-3 py-1 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fas fa-cog mr-2"></i> Settings
            </a>
            <div class="border-t border-gray-100"></div>
            <a href="/logout" class="block w-full text-left px-3 py-1 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fas fa-sign-out-alt mr-2"></i> Log out
            </a>
          </div>
          @else
          <a href="/login" class="px-2 py-1">
            <i class="fas fa-user text-gray-700 hover:text-black transition-colors"></i>
          </a>
          @endauth
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile Navigation Menu (Hidden by default) -->
  <div id="mobile-menu" class="md:hidden bg-white border-t mt-2">
    <nav class="py-2">
      <a href="/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->is('/') ? 'bg-gray-100 font-semibold text-gray-900' : '' }}">Home</a>
      <a href="/shop" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->is('shop*') ? 'bg-gray-100 font-semibold text-gray-900' : '' }}">Shop</a>
      <a href="/view-orders" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->is('view-orders*') ? 'bg-gray-100 font-semibold text-gray-900' : '' }}">Orders</a>
      <a href="/about" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->is('about*') ? 'bg-gray-100 font-semibold text-gray-900' : '' }}">About Us</a>
    </nav>
  </div>
</header>

<!-- Adding padding to the top of the body to prevent content from being hidden behind the fixed header -->
<div class="pt-20">
  <!-- Your page content starts here -->
</div>

<!-- JavaScript for Mobile Menu Toggle -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
      mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
      });
    }
  });
</script>