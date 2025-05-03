<header class="bg-white shadow-md py-4">
  <div class="max-w-7xl mx-auto px-3 flex flex-col md:flex-row items-center justify-between gap-4">
    <a href="{/}" class="text-2xl font-bold text-gray-900 relative group flex items-center gap-2">
      <img src="{{ asset('storage/images/logo.jpg') }}" alt="Faith Culture Logo" class="h-10">
      <div>Faith Culture</div>
      <span
        class="absolute left-0 bottom-0 w-full h-0.5 bg-black scale-x-0 group-hover:scale-x-100 transition-transform origin-right group-hover:origin-left"></span>
    </a>

    <nav class="flex flex-wrap justify-center md:justify-end gap-3">
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
      <a href="/cart"
        class="relative px-3 py-1  bg-gray-100 border-2 border-transparent rounded-lg  overflow-hidden group ">
        <span
          class="absolute inset-0 bg-gray-700 scale-x-0 z-0"></span>
          <i class="fa-solid fa-cart-plus">
          <span class="relative z-10"></span>
          </i>
          
      </a>
      
      <!-- Profile Button with Dropdown -->
      <div class="relative" x-data="{ open: false }">
        @auth
          <button @click="open = !open" @click.away="open = false" 
            class="flex items-center px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all hover:bg-gray-200 focus:outline-none">
            <i class="fas fa-user mr-2"></i>
            <span>{{ explode(' ', Auth::user()->name)[0] }}</span>
            <i class="fas fa-chevron-down ml-2 text-xs"></i>
          </button>
          
          <!-- Dropdown Menu -->
          <div x-show="open" 
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-150"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95"
               class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
            <a href="/profile" class="block px-3 py-1 text-sm text-gray-700 hover:bg-gray-100">
              <i class="fas fa-user-circle mr-2"></i> Profile
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
            class="relative px-3 py-1 font-medium text-black bg-gray-100 border-2 border-transparent rounded-lg transition-all overflow-hidden group hover:text-white hover:border-gray-900">
            <span
              class="absolute inset-0 bg-gray-700 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-right group-hover:origin-left z-0"></span>
            <span class="relative z-10"><i class="fas fa-user mr-2"></i> Login</span>
          </a>
        @endauth
      </div>
    </nav>
  </div>
</header>