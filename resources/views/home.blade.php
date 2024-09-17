<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="max-w-4xl mx-auto mt-4">
        <div class="flex items-center gap-2 [&_div]:cursor-pointer [&_div]:px-2 [&_div]:py-1 [&_div]:rounded [&_div]:text-sm">
            <div class="bg-gray-200">Tất cả</div>
            <div class="bg-red-600 text-white flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.348 14.652a3.75 3.75 0 0 1 0-5.304m5.304 0a3.75 3.75 0 0 1 0 5.304m-7.425 2.121a6.75 6.75 0 0 1 0-9.546m9.546 0a6.75 6.75 0 0 1 0 9.546M5.106 18.894c-3.808-3.807-3.808-9.98 0-13.788m13.788 0c3.808 3.807 3.808 9.98 0 13.788M12 12h.008v.008H12V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span>Trực tiếp</span>
            </div>
            <div class="bg-gray-200">Đã kết thúc</div>
            <div class="bg-gray-200">Lịch thi đâu</div>
        </div>
        <div class="space-y-2 mt-3">
            @foreach ($competitions as $competition)
            <div>
                <div class="bg-gray-200 py-2 rounded grid grid-cols-12 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 col-span-1 mx-auto text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                    <div class="col-span-11 flex items-center gap-2">
                        <img class="h-4 w-6" src="{{ $competition->country->logo }}" alt="">
                        <div class="text-sm font-medium">
                            <span class="text-gray-500">{{ $competition->country->name }}:</span>
                            <span>{{ $competition->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-2 divide-y text-sm">
                    @foreach ($competition->matches as $match)
                    <div class="grid grid-cols-12 py-1.5 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 col-span-1 mx-auto text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                        <div class="col-span-1 text-gray-500">
                            {{ $match->started_at->format('H:i') }}
                        </div>
                        <div class="col-span-2 text-red-600">
                            @if ($match->isInProgress())
                            {{ $match->playedMinutesTime() }}'
                            @else
                            {{ $match->status() }}
                            @endif
                        </div>
                        <div class="col-span-6">
                            <div class="flex items-center gap-2">
                                <span>{{ $match->homeTeam->name }}</span>
                                <img class="size-4" src="{{ $match->homeTeam->logo }}" />
                                <div class="text-red-600 font-semibold">
                                    {{ $match->home_scores[0] }} - {{ $match->away_scores[0] }}
                                </div>
                                <img class="size-4" src="{{ $match->awayTeam->logo }}" />
                                <span>{{ $match->awayTeam->name }}</span>
                            </div>
                        </div>
                        <div class="col-span-2 flex items-center text-gray-500 gap-4">
                            <div>HT {{ $match->home_scores[1] }} - {{ $match->away_scores[1] }}</div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                                </svg>
                                <span>{{ $match->home_scores[4] }} - {{ $match->away_scores[4] }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>