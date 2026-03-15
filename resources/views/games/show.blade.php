<x-app>
    <x-slot:title>
        {{ $stage->challenge->category }}
    </x-slot:title>
    
    <div class="flex flex-col gap-8">
        {{-- Game Header / Stats --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-base-200 p-4 rounded-xl">
            <h2 class="text-2xl font-bold text-primary">{{ $game->name }}</h2>
            <div class="stats shadow bg-base-100">
                <div class="stat place-items-center">
                    <div class="stat-title text-xs">Score</div>
                    <div class="stat-value text-primary text-2xl">{{ $stage->player->score }}</div>
                </div>
                <div class="stat place-items-center">
                    <div class="stat-title text-xs">Lives</div>
                    <div class="stat-value {{ $stage->lives <= 1 ? 'text-error' : 'text-secondary' }} text-2xl">{{ $stage->lives }}</div>
                </div>
            </div>
        </div>

        {{-- Game Status Alerts --}}
        @if($stage->isCompleted())
            <div class="alert alert-success shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="font-bold">Congratulations! You solved it!</span>
            </div>
        @elseif ($stage->isFailed())
            <div class="alert alert-error shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>You failed! The word was <span class="font-bold underline">{{ $stage->challenge->word }}</span></span>
            </div>
        @endif

        {{-- Game Board --}}
        <div class="flex flex-col items-center gap-6 py-8">
            <div class="badge badge-outline badge-lg italic opacity-70">{{ $stage->challenge->category }}</div>
            
            <div class="flex flex-wrap gap-2 justify-center py-4">
                {{-- This part represents the $stage display, assuming it renders the word blanks --}}
                <div class="text-4xl font-mono tracking-widest bg-base-200 p-6 rounded-box shadow-inner">
                    {{ $stage }}
                </div>
            </div>

            <form method="post" action="{{ route('games.update', compact('game')) }}" class="w-full">
                @method('put')
                @csrf

                <div class="flex flex-col gap-6">
                    @error('guess')
                        <div class="text-error text-center font-medium">{{ $message }}</div>
                    @enderror

                    <x-keyboard :disabled-keys="$disabledKeys"/>

                    <div class="flex justify-center pt-4">
                        @if(!$stage->isOver())
                            <button type="submit" name="skip" value="true" class="btn btn-ghost btn-sm text-error">
                                Skip Stage
                            </button>
                        @else
                            <button type="submit" form="next" class="btn btn-primary btn-wide shadow-lg">
                                Next Stage
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </button>
                        @endif
                    </div>
                </div>
            </form>
            
            <form id="next" method="get" action="{{ route('games.show', compact('game')) }}">
                <input type="hidden" name="next" value="true" />
            </form>
        </div>

        {{-- Leaderboard --}}
        @php $topGamers = $game->getTopGamers() @endphp
        @if($topGamers->isNotEmpty())
            <div class="divider">Leaderboard</div>
            <div class="card bg-base-200 shadow-sm border border-base-300">
                <div class="card-body p-4">
                    <h3 class="card-title text-lg mb-2 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-warning" fill="currentColor" viewBox="0 0 24 24"><path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94.49.79 1.2 1.41 2.05 1.79l-.44 2.22c-.17.85.47 1.62 1.33 1.62h5.33c.86 0 1.5-.77 1.33-1.62l-.44-2.22c.85-.38 1.56-1 2.05-1.79C20.08 10.63 22 8.55 22 8V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 2.82V7h2v1c0 1.3-.84 2.4-2 2.82z"/></svg>
                        Top Players
                    </h3>
                    <div class="space-y-2">
                        @foreach ($topGamers as $gamer)
                            <div class="flex justify-between items-center bg-base-100 p-2 rounded-lg">
                                <span class="flex items-center gap-2">
                                    <span class="badge badge-ghost badge-sm font-mono">{{ $loop->iteration }}</span>
                                    <span class="font-medium @if($gamer->name == auth()->user()->name) text-primary @endif">{{ $gamer->name }}</span>
                                </span>
                                <span class="font-bold text-secondary">{{ $gamer->player->score }} pts</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app>