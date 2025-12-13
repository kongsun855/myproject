@extends('layouts.app2')

@section('title', 'Home Page')

@section('content-article')
      
      <!-- Main Container -->
  <div class="min-h-screen flex flex-col ">

    <!-- Article Content -->
    <article class="max-w-4xl mx-auto px-6 py-12 md:py-20 -mt-20">

      <!-- Featured Image -->
      <div class="mb-10">
        <img src="{{ asset('storage/' . $post->featured_image) }}"
             alt="New ocean species discovered"
             class="w-full h-96 md:h-[500px] object-cover rounded-2xl shadow-xl">
      </div>

      <!-- Title -->
      <h1 class="text-4xl md:text-5xl font-bold text-black-900 mb-6 leading-tight">
        {{ $post ->title }}
      </h1>

      <!-- Date -->
      <div class="text-black-600 text-sm md:text-base mb-10 flex items-center gap-2">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h.01a1 1 0 100-2H6zm2 0a1 1 0 000 2h.01a1 1 0 100-2H8zm2 0a1 1 0 000 2h.01a1 1 0 100-2h-.01zm2 0a1 1 0 000 2h.01a1 1 0 100-2h-.01zm2 0a1 1 0 000 2h.01a1 1 0 100-2h-.01z" clip-rule="evenodd"/>
        </svg>
        <time datetime="2025-12-04">{{ $post->created_at }}</time>
      </div>

      <!-- Content / Description -->
      <div class="prose prose-lg max-w-none text-black-700">
        <p class="text-xl text-black-600 leading-relaxed mb-8">
          {{ $post->content }}
        </p>

        <p>
          The new species, temporarily named <strong>"Lumina abyssus"</strong>, emits a soft pulsating blue-green light and appears to use bioluminescence not just for defense, but for communication in complex patterns.
        </p>

        <p>
          "This isn't just a new jellyfish — it's an entirely new way of thinking about deep-sea life," said Dr. Elena Martinez, lead researcher. "These creatures are having conversations with light."
        </p>

        <p>
          The discovery was made during a routine deep-sea expedition using advanced robotic submersibles equipped with 8K cameras. The footage has already gone viral among ocean enthusiasts worldwide.
        </p>

        <p class="font-semibold text-lg mt-10">
          This finding reminds us how much of our own planet remains unexplored — and how magical it still is.
        </p>
      </div>

      <!-- Back Button -->
      <div class="mt-16 text-center">
        <a href="/home" class="inline-block px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg transition transform hover:scale-105">
          ← Back to Home
        </a>
      </div>
    </article>
    </div>


      
@endsection


