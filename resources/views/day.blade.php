@extends('theme::layouts.container')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">{{ $date->translatedFormat('Y. F j.') }}</h2>
        <a href="{{ route('post-calendar.index') }}" class="text-blue-600 hover:underline">&larr; Vissza a naptárhoz</a>
    </div>

    @if($posts->isEmpty())
        <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
            Ezen a napon nem született bejegyzés.
        </div>
    @else
        <x-cms-post-list :posts="$posts" />
    @endif
@endsection
