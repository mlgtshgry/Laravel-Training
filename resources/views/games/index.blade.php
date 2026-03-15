<x-app>
    <x-slot:title>
        Available Games
    </x-slot:title>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-xl font-bold">Games List</h2>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('games.create') }}" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                New Game
            </a>
            @if($owned)
            <a href="{{ route('games.index') }}" class="btn btn-ghost btn-sm">Show All Games</a>
            @else
            <a href="{{ route('games.index', ['owned'=>true]) }}" class="btn btn-ghost btn-sm">Show My Games</a>        
            @endif
        </div>
    </div>

    <div class="overflow-x-auto bg-base-100 rounded-lg">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Game Name</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($games as $game)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="font-medium">
                            {{ $game->name }} 
                            @if($game->creator->is(auth()->user()))
                                <div class="badge badge-secondary badge-sm ml-2">Mine</div>
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{ route('games.show', compact('game')) }}" class="btn btn-ghost btn-xs text-primary">Play</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-8 opacity-50 italic">No games found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app>
