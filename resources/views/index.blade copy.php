<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NewsTime</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Oswald Font -->
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600;700&display=swap" rel="stylesheet" />

  <style>
    .font-oswald { font-family: 'Oswald', sans-serif; }
    @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    .animate-spin-slow { animation: spin 1s linear infinite; }
    body{
        scroll-behavior: smooth;
    }
  </style>
</head>
<body class="min-h-screen bg-cover bg-center bg-fixed flex items-center justify-center p-4"
      style="background-image: url('https://4kwallpapers.com/images/walls/thumbs_3t/11209.jpg');">

  <!-- Loader -->
  <div id="loader" class="fixed inset-0 bg-white flex items-center justify-center z-50 transition-opacity duration-500">
    <div class="w-16 h-16 border-8 border-gray-200 border-t-blue-600 rounded-full animate-spin-slow"></div>
  </div>

  <!-- Main Container -->
  <div class="w-full max-w-7xl mx-auto bg-white/15 backdrop-blur-3xl rounded-3xl p-6 shadow-2xl">

    <!-- Sticky Top Bar -->
    <header class="sticky top-4 z-40 -m-6 mb-8">
      <div class="bg-white/45 backdrop-blur-xl rounded-3xl border border-white/10 shadow-lg transition-all duration-300 scrolled:bg-black/65 scrolled:backdrop-blur-2xl">

        <!-- Navigation Bar -->
        <nav class="flex flex-wrap items-center justify-between gap-4 px-6 py-5 md:px-8">
          <!-- Search -->
          <input 
            type="text" 
            placeholder="Search here" 
            class="hidden md:block bg-transparent border border-white text-white placeholder-white/70 text-center rounded-xl h-12 w-56 focus:outline-none focus:ring-2 focus:ring-white/50 transition" 
          />

          <!-- Logo -->
          <h1 class="text-3xl md:text-4xl font-bold text-red-600 font-oswald">SunNews</h1>

          <!-- Desktop Right Side -->
          <div class="hidden md:flex items-center gap-6">
            <a href="#" class="text-blue-600 text-xl font-medium hover:text-blue-400 transition">Profile</a>
            <button class="px-8 h-11 bg-transparent border border-amber-100 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition">
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
          <div class="flex flex-col md:flex-row justify-center gap-6 md:gap-8 py-6 md:py-4 text-lg font-medium border-t border-white/20 md:border-none">
            <a href="#" class="text-rose-100 hover:text-white hover:bg-rose-600/40 px-6 py-3 rounded-full transition text-center">Latest</a>
            <a href="#" class="text-rose-100 hover:text-white hover:bg-rose-600/40 px-6 py-3 rounded-full transition text-center">World</a>
            <a href="#" class="text-rose-100 hover:text-white hover:bg-rose-600/40 px-6 py-3 rounded-full transition text-center">Sport</a>
            <a href="#" class="text-rose-100 hover:text-white hover:bg-rose-600/40 px-6 py-3 rounded-full transition text-center">Culture</a>
            <a href="#" class="text-rose-100 hover:text-white hover:bg-rose-600/40 px-6 py-3 rounded-full transition text-center">Wellness</a>
            <a href="#" class="text-rose-100 hover:text-white hover:bg-rose-600/40 px-6 py-3 rounded-full transition text-center">Economy</a>
          </div>

          <!-- Mobile-only links (Profile & Sign in) -->
          <div class="md:hidden flex flex-col gap-4 px-8 pb-6 border-t border-white/20 pt-4">
            <a href="#" class="text-blue-400 text-center text-lg font-medium">Profile</a>
            <button class="w-full py-3 bg-amber-600/20 border border-amber-400 text-amber-400 rounded-xl hover:bg-amber-600 hover:text-white transition">
              Sign in
            </button>
          </div>
        </div>
      </div>
    </header>
    <h1>hello</h1>

    <!-- News Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Card Template (Repeat as needed) -->
      @foreach($post as $post)
      <article class="relative group overflow-hidden rounded-2xl h-96 cursor-pointer transition-transform duration-300 hover:-translate-y-3">
        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="News" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
        <p class="absolute bottom-24 left-6 right-6 text-white text-base leading-relaxed z-10">
          {{ $post->title }}
        </p>
        <div class="absolute bottom-0 left-0 right-0 flex justify-between items-center p-6 bg-white/35 backdrop-blur-md z-10">
          <span class="bg-red-600 text-white text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-full">{{ $post->category->name }}</span>
          <time class="text-white/90 text-sm font-medium">2 December 2025</time>
        </div>
        </article>
        @endforeach

      <!-- Repeat above card 6 times or use JS to generate -->
      <!-- ... (6 more cards same as above) ... -->
      <!-- For brevity, I'm showing just one. Copy-paste the <article> block 6 more times -->
    </div>
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