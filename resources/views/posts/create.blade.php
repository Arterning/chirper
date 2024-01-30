<!-- Post Create Form include Title and Content Field -->
<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form method="POST" action="{{ route('posts.store') }}"
                    class="mt-6 space-y-6">
                @csrf
                @method('POST')
                <input name="title" placeholder="{{ __('Title') }}" 
                    class="block w-full border-gray-300 focus:border-indigo-300
                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                <textarea
                    name="content"
                    placeholder="{{ __('What\'s on your mind?') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ old('content') }}</textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <div class="mt-4 space-x-2">
                    <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
                    <a href="{{ route('posts.index') }}">{{ __('Cancel') }}</a>
                </div>
            </form>
    </div>
</x-app-layout>
