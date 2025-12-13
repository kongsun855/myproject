@extends('layouts.app2')

@section('title', 'Home Page')

@section('content')
<!-- News Cards Grid -->
    
      <!-- Card Template (Repeat as needed) -->
      @foreach($post as $post)
      
      <a href="{{ route('article', $post->id) }}">
      <article  class="relative group overflow-hidden rounded-2xl h-96 cursor-pointer transition-transform duration-300 hover:-translate-y-3">
        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="News" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent"></div>
        <p class="absolute bottom-24 left-6 right-6 text-white text-base leading-relaxed z-10">
          {{ $post->title }}
        </p>
        <div class="absolute bottom-0 left-0 right-0 flex justify-between items-center p-6 bg-white/35 backdrop-blur-md z-10">
          <span class="bg-red-600 text-white text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-full">{{ $post->category->name }}</span>
          <time class="text-white/90 text-sm font-medium">{{ $post->created_at }}</time>
        </div>
        </article>
        </a>
        
        @endforeach

      
@endsection