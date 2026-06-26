@extends($layout)

@section('sidebar')
    <x-theme::template view="post-calendar::index.partials.sidebar" />
@endsection

@section('top')
    <x-theme::template view="post-calendar::index.partials.top" />
@endsection

@section('bottom')
    <x-theme::template view="post-calendar::index.partials.bottom" />
@endsection

@section('page-top')
    <x-theme::template view="post-calendar::index.partials.page-top" />
@endsection

@section('page-bottom')
    <x-theme::template view="post-calendar::index.partials.page-bottom" />
@endsection

@section('content-top')
    <x-theme::template view="post-calendar::index.partials.content-top" />
@endsection

@section('content-bottom')
    <x-theme::template view="post-calendar::index.partials.content-bottom" />
@endsection

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow overflow-hidden my-8">
        <div class="flex items-center justify-between px-6 py-4 bg-gray-800 text-white">
            <h2 class="text-xl font-bold">{{ $startDate->translatedFormat('F Y') }}</h2>
            <div class="flex space-x-2">
                <a href="{{ route('post-calendar.index', ['month' => $startDate->copy()->subMonth()->month, 'year' => $startDate->copy()->subMonth()->year]) }}" class="px-3 py-1 bg-gray-700 hover:bg-gray-600 rounded">&lt; Előző</a>
                <a href="{{ route('post-calendar.index', ['month' => $startDate->copy()->addMonth()->month, 'year' => $startDate->copy()->addMonth()->year]) }}" class="px-3 py-1 bg-gray-700 hover:bg-gray-600 rounded">Következő &gt;</a>
            </div>
        </div>

        <div class="grid grid-cols-7 border-b border-gray-200">
            @foreach(['H', 'K', 'Sze', 'Cs', 'P', 'Szo', 'V'] as $day)
                <div class="py-2 text-center text-sm font-semibold text-gray-700 bg-gray-50">{{ $day }}</div>
            @endforeach
        </div>

        <div class="grid grid-cols-7">
            {{-- Üres napok a hónap elején --}}
            @php
                $firstDayOfWeek = $startDate->dayOfWeekIso;
            @endphp
            @for($i = 1; $i < $firstDayOfWeek; $i++)
                <div class="h-24 border-r border-b border-gray-100 bg-gray-50"></div>
            @endfor

            {{-- Napok --}}
            @for($date = $startDate->copy(); $date->lte($endDate); $date->addDay())
                @php
                    $dateStr = $date->format('Y-m-d');
                    $hasPosts = $postsByDay->has($dateStr);
                @endphp
                <div class="h-24 border-r border-b border-gray-100 relative {{ $date->isToday() ? 'bg-blue-50' : '' }}">
                    <div class="absolute top-2 right-2 text-sm {{ $date->isToday() ? 'font-bold text-blue-600' : 'text-gray-500' }}">
                        {{ $date->day }}
                    </div>
                    @if($hasPosts)
                        <div class="absolute bottom-2 left-2 right-2">
                            <a href="{{ route('post-calendar.day', ['date' => $dateStr]) }}" class="block w-full text-center py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                {{ $postsByDay->get($dateStr)->count() }} bejegyzés
                            </a>
                        </div>
                    @endif
                </div>
            @endfor

            {{-- Üres napok a hónap végén --}}
            @php
                $lastDayOfWeek = $endDate->dayOfWeekIso;
            @endphp
            @for($i = $lastDayOfWeek; $i < 7; $i++)
                <div class="h-24 border-r border-b border-gray-100 bg-gray-50"></div>
            @endfor
        </div>
    </div>
@endsection
