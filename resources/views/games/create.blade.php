<x-app>
    <x-slot:title>
        New Game
    </x-slot:title>
    
    <div class="max-w-md mx-auto">
        <form method="post" action="{{ route('games.store') }}" class="space-y-4">
            @csrf
            <div class="form-control w-full">
                <label class="label" for="name">
                    <span class="label-text font-semibold">Game Name</span>
                </label>
                <input id="name" name="name" type="text" placeholder="Enter a name for your game" class="input input-bordered w-full" value="{{ old('name') }}" required >
                @error('name')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="pt-4 flex gap-2">
                <button type="submit" class="btn btn-primary flex-1">Create Game</button>
                <a href="{{ route('games.index') }}" class="btn btn-ghost">Cancel</a>
            </div>
        </form>
    </div>
</x-app>