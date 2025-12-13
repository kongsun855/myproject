{{-- resources/views/admin/posts/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">

                    <!-- Main Update Form -->
                    <form id="postForm"
                          action="{{ route('admin.posts.update', $post) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-8">
                            <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   value="{{ old('title', $post->title) }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                   required>
                            @error('title')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="mb-8">
                            <label for="slug" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Slug
                                <span class="text-xs text-gray-500">(leave empty to keep current)</span>
                            </label>
                            <div class="flex items-center gap-3">
                                <span class="text-gray-500 dark:text-gray-400">https://yoursite.com/</span>
                                <input type="text"
                                       name="slug"
                                       id="slug"
                                       value="{{ old('slug', $post->slug) }}"
                                       placeholder="{{ $post->slug }}"
                                       class="flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            </div>
                            @error('slug')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-8">
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" id="category_id"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    required>
                                <option value="">-- Choose a category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Featured Image
                            </label>

                            <!-- Current Image -->
                            @if($post->featured_image)
                                <div class="mb-6 relative inline-block">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full max-w-2xl h-80 object-cover rounded-xl shadow-lg border-4 border-white dark:border-gray-700">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-40 transition flex items-center justify-center rounded-xl">
                                        <span class="text-white opacity-0 hover:opacity-100 font-medium text-lg">
                                            Current Image
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <!-- Upload New Image -->
                            <div class="mt-4">
                                <input type="file"
                                       name="featured_image"
                                       id="featured_image"
                                       accept="image/*"
                                       class="block w-full text-sm text-gray-600 dark:text-gray-400
                                              file:mr-4 file:py-3 file:px-6
                                              file:rounded-lg file:border-0
                                              file:text-sm file:font-medium
                                              file:bg-indigo-600 file:text-white
                                              hover:file:bg-indigo-700 cursor-pointer">
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    Leave empty to keep current image
                                </p>
                            </div>

                            <!-- New Image Preview -->
                            <div id="image-preview" class="mt-6 hidden">
                                <p class="text-sm font-medium text-green-600 mb-3">New Image Preview:</p>
                                <div class="relative inline-block">
                                    <img id="preview-img" src="" alt="Preview"
                                         class="w-full max-w-2xl h-80 object-cover rounded-xl shadow-lg border-4 border-green-500">
                                    <button type="button" id="remove-image"
                                            class="absolute top-3 right-3 bg-red-600 hover:bg-red-700 text-white rounded-full p-2.5 shadow-lg transition">
                                        Remove
                                    </button>
                                </div>
                            </div>

                            @error('featured_image')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-8">
                            <label for="content" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Content <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content"
                                      id="content"
                                      rows="15"
                                      class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                      required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Publish Status -->
                        <div class="mb-8 flex items-center">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox"
                                       name="is_active"
                                       value="1"
                                       {{ old('is_active', $post->is_active) ? 'checked' : '' }}
                                       class="w-5 h-5 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500">
                                <span class="ml-3 text-base font-medium text-gray-700 dark:text-gray-300">
                                    Published (Uncheck to save as draft)
                                </span>
                            </label>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 border-t border-gray-200 dark:border-gray-700 pt-8">
                            <div class="flex gap-4 order-2 sm:order-1">
                                <button type="submit"
                                        form="postForm"
                                        class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-blue-600 font-semibold rounded-lg shadow-md transition transform hover:scale-105">
                                    Update Post
                                </button>
                                <a href="{{ route('admin.posts.index') }}"
                                   class="px-6 py-3 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white font-medium transition">
                                    Cancel
                                </a>
                            </div>

                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Auto-generate slug only if user hasn't edited it manually
        let slugEdited = false;
        const slugField = document.getElementById('slug');
        slugField.addEventListener('input', () => slugEdited = true);

        document.getElementById('title').addEventListener('input', function () {
            if (!slugEdited) {
                const slug = this.value
                    .trim()
                    .toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .replace(/^-+|-+$/g, '');

                slugField.value = slug || '';
            }
        });

        // Image Preview
        document.getElementById('featured_image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });

        // Remove uploaded image
        document.getElementById('remove-image')?.addEventListener('click', function () {
            document.getElementById('featured_image').value = '';
            document.getElementById('image-preview').classList.add('hidden');
        });
    </script>
</x-app-layout>