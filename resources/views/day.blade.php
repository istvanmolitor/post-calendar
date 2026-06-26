@extends($layout)

@section('sidebar')
    <x-theme::template view="post-calendar::day.partials.sidebar" />
@endsection

@section('top')
    <x-theme::template view="post-calendar::day.partials.top" />
@endsection

@section('bottom')
    <x-theme::template view="post-calendar::day.partials.bottom" />
@endsection

@section('page-top')
    <x-theme::template view="post-calendar::day.partials.page-top" />
@endsection

@section('page-bottom')
    <x-theme::template view="post-calendar::day.partials.page-bottom" />
@endsection

@section('content-top')
    <x-theme::template view="post-calendar::day.partials.content-top" />
@endsection

@section('content-bottom')
    <x-theme::template view="post-calendar::day.partials.content-bottom" />
@endsection

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
        <x-cms::post-list :posts="$posts" />
    @endif
@endsection
