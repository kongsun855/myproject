<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600"
                                   required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="flex items-center gap-3">
                                <span class="text-gray-500 dark:text-gray-400">https://yoursite.com/</span>
                                <input type="text"
                                       name="slug"
                                       id="slug"
                                       value=""
                                       placeholder=""
                                       class="flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            </div>


                        <div class="mb-6">
                            <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Slug (optional)
                            </label>
                            <input type="text" 
                                   name="slug" 
                                   id="slug" 
                                   value="{{ old('slug') }}"
                                   placeholder="auto-generated-if-empty"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                            @error('slug')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-6">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" 
                                    id="category_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600"
                                    required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-6">
                            <label for="featured_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Featured Image
                            </label>
                            <input type="file"
                                   name="featured_image"
                                   id="featured_image"
                                   accept="image/*"
                                   class="mt-1 block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-md file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-indigo-600 file:text-white
                                          hover:file:bg-indigo-700">
                            
                            <!-- Live Preview -->
                            <div id="image-preview" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Preview:</p>
                                <img id="preview-img" src="" alt="Image preview" class="h-64 w-full object-cover rounded-lg shadow-md">
                            </div>

                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Content <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content" 
                                      id="content" 
                                      rows="10"
                                      class="mt-mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600"
                                      required>{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Active Checkbox -->
                        <div class="mb-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Publish immediately</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center gap-4">
                            <button type="submit"
                                    class="px-6 py-3 bg-indigo-600 text-blue-600 font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Save Post
                            </button>
                            <a href="{{ route('admin.posts.index') }}" 
                               class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- Live Image Preview Script --}}
<script>
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
        previewImg.src = '';
    }
});
</script>