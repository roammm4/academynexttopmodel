<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academy NTM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body>
<header class="flex justify-between items-center px-4 md:px-12 py-5 bg-black z-30 font-['Open_Sans']">
  <!-- Logo -->
  <div class="logo flex-shrink-0">
    <img src="img/logo.jpg" alt="Logo" class="h-16">
  </div>
  <!-- Hamburger (mobile & tablet) -->
  <button id="hamburgerBtn" class="md:hidden flex flex-col justify-center items-center w-10 h-10 focus:outline-none" aria-label="Open Menu">
    <span class="block w-7 h-0.5 bg-white mb-1"></span>
    <span class="block w-7 h-0.5 bg-white mb-1"></span>
    <span class="block w-7 h-0.5 bg-white"></span>
  </button>
  <!-- Menu Desktop -->
  <nav class="hidden md:block flex-1">
    <ul class="flex list-none gap-1.5 items-center text-sm tracking-wider justify-center">
      <li><a href="{{ url('/') }}" class="text-white px-4 py-2 rounded-lg transition duration-300 hover:bg-white hover:text-black font-medium">{{ __('messages.home') }}</a></li>
      <li><a href="{{ url('/#aboutus') }}" class="text-white px-4 py-2 rounded-lg transition duration-300 hover:bg-white hover:text-black font-medium">{{ __('messages.about_us') }}</a></li>
      <li><a href="{{ url('/joinacademy') }}" class="text-white px-4 py-2 rounded-lg transition duration-300 hover:bg-white hover:text-black font-medium">{{ __('messages.model_course') }}</a></li>
      <li><a href="{{ url('/models') }}" class="text-white px-4 py-2 rounded-lg transition duration-300 hover:bg-white hover:text-black font-medium">{{ __('messages.models') }}</a></li>
      <li><a href="{{ url('/#contactus') }}" class="text-white px-4 py-2 rounded-lg transition duration-300 hover:bg-white hover:text-black font-medium">{{ __('messages.contact_us') }}</a></li>
      @auth
        @if(auth()->user()->role === 'admin')
          <li><a href="{{ url('/admin') }}" class="text-white px-4 py-2 rounded-lg transition duration-300 hover:bg-white hover:text-black font-medium">{{ __('messages.admin') }}</a></li>
        @endif
      @endauth
      <li class="relative" x-data="{ open: false }" @click.away="open = false">
  <button @click="open = !open"
    class="flex items-center gap-2 px-4 py-2 text-white rounded-lg hover:bg-white hover:text-black font-medium focus:outline-none">
    <span class="inline-block w-5 h-5 rounded-full overflow-hidden align-middle">
      <img src="https://flagcdn.com/24x18/gb.png" alt="English"
        class="w-5 h-5 rounded-full border border-gray-300"
        style="display: {{ app()->getLocale() == 'en' ? 'inline' : 'none' }};" />
      <img src="https://flagcdn.com/24x18/id.png" alt="Indonesia"
        class="w-5 h-5 rounded-full border border-gray-300"
        style="display: {{ app()->getLocale() == 'id' ? 'inline' : 'none' }};" />
    </span>
    <span>{{ strtoupper(app()->getLocale()) }}</span>
    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <!-- Dropdown -->
  <ul x-show="open" x-transition
    class="absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg py-2 z-50"
    style="display: none;">
    <li>
      <a href="{{ route('lang.switch', 'en') }}"
        class="flex items-center gap-2 px-4 py-2 text-black hover:bg-gray-100">
        <img src="https://flagcdn.com/24x18/gb.png" alt="English"
          class="w-5 h-5 rounded-full border border-gray-300" />
        English
      </a>
    </li>
    <li>
      <a href="{{ route('lang.switch', 'id') }}"
        class="flex items-center gap-2 px-4 py-2 text-black hover:bg-gray-100">
        <img src="https://flagcdn.com/24x18/id.png" alt="Indonesia"
          class="w-5 h-5 rounded-full border border-gray-300" />
        Indonesia
      </a>
    </li>
  </ul>
</li>

    </ul>
  </nav>
  <!-- Auth Desktop -->
  <div class="hidden md:flex items-center gap-2">
    @guest
      <a href="{{ url('/login') }}" class="bg-gray-200 text-black text-sm px-4 py-1.5 rounded">{{ __('messages.loginbutton') }}</a>
      <a href="{{ url('/register') }}" class="bg-[#2C2C2C] text-white text-sm px-4 py-1.5 rounded">{{ __('messages.regisbutton') }}</a>
    @else
      <div class="flex items-end gap-3">
        <a href="{{ route('profile.edit') }}" class="bg-white text-black text-sm px-4 py-1.5 rounded font-semibold">{{ __('messages.editprofilebutton') }}</a>
        <form action="{{ route('auth.logout') }}" method="POST" class="m-0">
          @csrf
          <button type="submit" class="bg-[#2C2C2C] text-white text-sm px-4 py-1.5 rounded">{{ __('messages.logoutbutton') }}</button>
        </form>
      </div>
    @endguest
  </div>
</header>
<hr class="border-t border-gray-700 shadow-sm m-0 p-0">
<!-- Mobile/Tablet Dropdown Menu -->
<div id="mobileMenu" class="w-full bg-black shadow-lg py-0 px-0 flex flex-col gap-4 md:hidden transition-all duration-300 max-h-0 overflow-hidden pointer-events-none font-['Open_Sans']">
  <ul class="flex flex-col gap-2">
    <li><a href="{{ url('/') }}" class="text-white block px-4 py-2 rounded-lg hover:bg-white hover:text-black font-medium">{{ __('messages.home') }}</a></li>
    <li><a href="{{ url('/#aboutus') }}" class="text-white block px-4 py-2 rounded-lg hover:bg-white hover:text-black font-medium">{{ __('messages.about_us') }}</a></li>
    <li><a href="{{ url('/joinacademy') }}" class="text-white block px-4 py-2 rounded-lg hover:bg-white hover:text-black font-medium">{{ __('messages.model_course') }}</a></li>
    <li><a href="{{ url('/models') }}" class="text-white block px-4 py-2 rounded-lg hover:bg-white hover:text-black font-medium">{{ __('messages.models') }}</a></li>
    <li><a href="{{ url('/#contactus') }}" class="text-white block px-4 py-2 rounded-lg hover:bg-white hover:text-black font-medium">{{ __('messages.contact_us') }}</a></li>
    @auth
      @if(auth()->user()->role === 'admin')
        <li><a href="{{ url('/admin') }}" class="text-white block px-4 py-2 rounded-lg hover:bg-white hover:text-black font-medium">{{ __('messages.admin') }}</a></li>
      @endif
    @endauth
    <!-- Dropdown Bahasa dengan Alpine.js -->
<li class="relative" x-data="{ open: false }" @click.away="open = false">
  <button @click="open = !open"
    class="flex items-center gap-2 px-4 py-2 text-white rounded-lg hover:bg-white hover:text-black font-medium focus:outline-none">
    <span class="inline-block w-5 h-5 rounded-full overflow-hidden align-middle">
      <img src="https://flagcdn.com/24x18/gb.png" alt="English"
        class="w-5 h-5 rounded-full border border-gray-300"
        style="display: {{ app()->getLocale() == 'en' ? 'inline' : 'none' }};" />
      <img src="https://flagcdn.com/24x18/id.png" alt="Indonesia"
        class="w-5 h-5 rounded-full border border-gray-300"
        style="display: {{ app()->getLocale() == 'id' ? 'inline' : 'none' }};" />
    </span>
    <span>{{ strtoupper(app()->getLocale()) }}</span>
    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <!-- Dropdown -->
  <ul x-show="open" x-transition
    class="absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg py-2 z-50"
    style="display: none;">
    <li>
      <a href="{{ route('lang.switch', 'en') }}"
        class="flex items-center gap-2 px-4 py-2 text-black hover:bg-gray-100">
        <img src="https://flagcdn.com/24x18/gb.png" alt="English"
          class="w-5 h-5 rounded-full border border-gray-300" />
        English
      </a>
    </li>
    <li>
      <a href="{{ route('lang.switch', 'id') }}"
        class="flex items-center gap-2 px-4 py-2 text-black hover:bg-gray-100">
        <img src="https://flagcdn.com/24x18/id.png" alt="Indonesia"
          class="w-5 h-5 rounded-full border border-gray-300" />
        Indonesia
      </a>
    </li>
  </ul>
</li>

  </ul>
  <div class="flex gap-2 mt-2">
    @guest
      <a href="{{ url('/login') }}" class="bg-gray-200 text-black text-sm px-4 py-1.5 rounded w-1/2 text-center">{{ __('messages.loginbutton') }}</a>
      <a href="{{ url('/register') }}" class="bg-[#2C2C2C] text-white text-sm px-4 py-1.5 rounded w-1/2 text-center">{{ __('messages.regisbutton') }}</a>
    @else
      <div class="flex flex-col w-full">
        <a href="{{ route('profile.edit') }}" class="bg-white text-black text-sm px-4 py-1.5 rounded font-semibold w-full text-center mb-2">{{ __('messages.editprofilebutton') }}</a>
        <form action="{{ route('auth.logout') }}" method="POST" class="m-0 mt-2">
          @csrf
          <button type="submit" class="bg-[#2C2C2C] text-white text-sm px-4 py-1.5 rounded w-full">{{ __('messages.logoutbutton') }}</button>
        </form>
      </div>
    @endguest
  </div>
</div>
</body>
</html> 
