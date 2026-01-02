<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 dark:bg-green-900 border border-green-400 text-white px-4 py-5 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <a href="{{route('admin.posts.create')}}" class="px-4 py-2 text-right rounded bg-white"> Add </a>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <table class="min-w-full w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-left text-gray-900 dark:text-gray-100">ID</th>
                            <th class="px-6 py-4 text-left text-gray-900 dark:text-gray-100">Cover</th>
                            <th class="px-6 py-4 text-left text-gray-900 dark:text-gray-100">Title</th>
                            <th class="px-6 py-4 text-left text-gray-900 dark:text-gray-100">Content</th>
                            <th class="px-6 py-4 text-left text-gray-900 dark:text-gray-100">Category</th>
                            <th class="px-6 py-4 text-left text-gray-900 dark:text-gray-100">Status</th>
                            <th class="px-6 py-4 text-left text-gray-900 dark:text-gray-100">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($post as $post)
                            <tr class="border-t border-gray-200 dark:border-gray-700">
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100"><img src="{{ asset('storage/' . $post->featured_image_url) }}" alt="News" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" /></td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $post->id }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $post->title }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $post->content }}</td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $post->category->name }}</td> 
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                    {{ $post->is_active ? 'Active' : 'Inactive' }}
                                </td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                    |
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to delete this post?');">Delete</button>
                                    </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>