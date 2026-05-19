@extends('theme::layouts.container')

@section('content')
    <div class="max-w-2xl mx-auto my-8">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">{{ $date->translatedFormat('Y. F j.') }}</h2>
            <a href="{{ route('post-calendar.index') }}" class="text-blue-600 hover:underline">&larr; Vissza a naptárhoz</a>
        </div>

        @if($posts->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
                Ezen a napon nem született bejegyzés.
            </div>
        @else
            <div class="space-y-4">
                @foreach($posts as $post)
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                        <h3 class="text-xl font-semibold mb-2">
                            <a href="/post/{{ $post->slug }}" class="text-blue-700 hover:text-blue-900">{{ $post->title }}</a>
                        </h3>
                        @if($post->lead)
                            <p class="text-gray-600 line-clamp-2">{{ $post->lead }}</p>
                        @endif
                        <div class="mt-4 text-sm text-gray-400">
                            Közzétéve: {{ $post->created_at->format('H:i') }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
