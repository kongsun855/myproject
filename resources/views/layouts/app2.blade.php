<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Page Title')</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

  <!-- Oswald Font -->
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600;700&display=swap" rel="stylesheet" />

  <style>
    .font-oswald {
      font-family: 'Oswald', sans-serif;
    }

    @keyframes spin {
      from {
        transform: rotate(0deg);
      }

      to {
        transform: rotate(360deg);
      }
    }

    .animate-spin-slow {
      animation: spin 1s linear infinite;
    }

    body {
      scroll-behavior: smooth;
    }

    /* Smooth slow back-and-forth animation */
    @keyframes backAndForthSmooth {
      0% {
        transform: translateX(0);
      }

      20% {
        transform: translateX(0);
      }

      40% {
        transform: translateX(-100%);
      }

      60% {
        transform: translateX(-200%);
      }

      80% {
        transform: translateX(-100%);
      }

      100% {
        transform: translateX(0);
      }
    }

    .slider-animate {
      animation: backAndForthSmooth 22s ease-in-out infinite;
    }
  </style>
</head>

<body class="min-h-screen bg-cover bg-center bg-fixed flex items-center justify-center p-4"
  style="background-image: url('https://4kwallpapers.com/images/walls/thumbs_3t/11209.jpg');">

  <!-- Loader -->
  <div id="loader" class="fixed inset-0 bg-white flex items-center justify-center z-50 transition-opacity duration-500">
    <div class="w-16 h-16 border-8 border-gray-200 border-t-blue-600 rounded-full animate-spin-slow"></div>
  </div>

  <!-- THIS IS THE BUTTON YOU WANT -->
  <button class="fixed bottom-6 right-10 z-50 
                  bg-blue-600 hover:bg-blue-700 active:bg-blue-800
                  text-white font-bold 
                  w-40 h-12 rounded-3xl shadow-2xl 
                  flex items-center justify-center
                  transition-all duration-300 
                  hover:scale-110">
    <!-- You can put icon or text here -->
    Support Me
  </button>

  <!-- Main Container -->
  <div class="w-full max-w-7xl mx-auto bg-white/15 backdrop-blur-3xl rounded-3xl p-6 shadow-2xl">

    {{-- slider --}}




    <!-- Sticky Top Bar -->
    <header class="sticky top-4 z-40 -m-6 mb-8">
      <div
        class="bg-black/15 backdrop-blur-xl rounded-3xl border border-white/10 shadow-lg transition-all duration-300 scrolled:bg-black/65 scrolled:backdrop-blur-2xl">

        <!-- Navigation Bar -->
        <nav class="flex flex-wrap items-center justify-between gap-4 px-6 py-5 md:px-8">
          <!-- Search -->
          <input type="text" placeholder="Search here"
            class="hidden md:block bg-transparent border border-white text-white placeholder-white/70 text-center rounded-xl h-12 w-56 focus:outline-none focus:ring-2 focus:ring-white/50 transition" />

          <!-- Logo -->
          <a href="/">
            <h1 class="text-3xl md:text-4xl font-bold text-red-600 font-oswald"><span
                class="text-blue-600">Sun</span>News</h1>
          </a>

          <!-- Desktop Right Side -->
          <div class="hidden md:flex items-center gap-6">
            <a href="#" class="text-green-600 text-xl font-medium hover:text-green-400 transition">Profile</a>
            <button
              class="px-8 h-11 bg-transparent border border-amber-100 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition">
              Sign in
            </button>
          </div>

          <!-- Mobile Menu Button -->
          <button id="menu-btn" class="md:hidden text-white text-3xl focus:outline-none">
            Menu
          </button>
        </nav>

        <!-- Categories: Desktop Horizontal | Mobile Dropdown -->
        <div id="category-menu" class="transition-all duration-300 ease-in-out overflow-hidden max-h-0 md:max-h-none">
          <div
            class="flex flex-col md:flex-row justify-center gap-6 md:gap-8 py-6 md:py-4 text-lg font-medium border-t border-white/20 md:border-none">

            <a href="/"
              class="text-rose-100 hover:text-white hover:bg-rose-600/40 px-6 py-3 rounded-full transition text-center">Home</a>

            @foreach($categories ?? [] as $category)
              <a href="{{ route('home', ['category' => $category->id]) }}"
                class="text-rose-100 hover:text-white hover:bg-rose-600/40 px-6 py-3 rounded-full transition text-center">
                {{ $category->name }}
              </a>
            @endforeach


          </div>

          <!-- Mobile-only links (Profile & Sign in) -->
          <div class="md:hidden flex flex-col gap-4 px-8 pb-6 border-t border-white/20 pt-4">
            <a href="#" class="text-green-600 text-center text-lg font-medium">Profile</a>
            <button
              class="w-full py-3 bg-amber-600/20 border border-amber-400 text-amber-400 rounded-xl hover:bg-amber-600 hover:text-white transition">
              Sign in
            </button>
          </div>
        </div>
      </div>
    </header>

    {{-- slider --}}
    <div class=" mx-auto mt-10 overflow-hidden rounded-2xl shadow-xl relative">

      <div class="flex slider-animate w-[60%]">

        <!-- Slide 1 -->
        <div class="w-full aspect-[16/9] shrink-0 relative">
          <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=3500&q=85"
            class="w-full h-full object-cover">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-red-400/40 p-4 rounded">
              <h1 class="text-white text-4xl font-bold">Welcome To</h1>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="w-full aspect-[16/9] shrink-0 relative">
          <img src="https://images.unsplash.com/photo-1521295121783-8a321d551ad2?auto=format&fit=crop&w=3500&q=85"
            class="w-full h-full object-cover">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-green-400/40 p-4 rounded">
              <h1 class="text-white text-4xl font-bold">SunNews</h1>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="w-full aspect-[16/9] shrink-0 relative">
          <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=3500&q=85"
            class="w-full h-full object-cover">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-blue-400/40 p-4 rounded">
              <h1 class="text-white text-4xl font-bold">Today</h1>
            </div>
          </div>
        </div>

      </div>

    </div>


    <!-- News Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
      @yield('content')


    </div>
    @yield('content-article')


    <footer class="rounded-3xl border border-white/10 bg-gray-800 text-white py-8 mt-6 ">
      <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm">
          © 2025 SunNews. All rights reserved.
        </p>
        <p class="text-xs text-gray-400 mt-2">
          ✅ Un KongSun | PSBU Web Development
        </p>
      </div>
    </footer>
  </div>



  <!-- Scripts -->
  <script>
    // Loader fade out
    window.addEventListener('load', () => {
      setTimeout(() => {
        document.getElementById('loader').classList.add('opacity-0', 'pointer-events-none');
      }, 500);
    });

    // Mobile menu toggle
    const menuBtn = document.getElementById('menu-btn');
    const categoryMenu = document.getElementById('category-menu');

    menuBtn.addEventListener('click', () => {
      const isOpen = categoryMenu.classList.contains('max-h-96');
      categoryMenu.classList.toggle('max-h-96', !isOpen);
      categoryMenu.classList.toggle('max-h-0', isOpen);
      menuBtn.textContent = isOpen ? 'Menu' : 'Close';
    });

    // Optional: Shrink top bar on scroll
    window.addEventListener('scroll', () => {
      document.querySelector('header > div').classList.toggle('scrolled', window.scrollY > 50);
    });
  </script>
</body>

</html>