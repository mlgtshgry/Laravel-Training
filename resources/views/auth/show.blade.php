<x-app>
    <x-slot:title>
        Log-in
    </x-slot:title>

    <div class="max-w-md mx-auto">
        <form method="post" action="{{ route('auth.login') }}" class="space-y-4">
            @csrf
            <div class="form-control w-full">
                <label class="label" for="name">
                    <span class="label-text">Name</span>
                </label>
                <input type="text" name="name" id="name" placeholder="Enter your name" class="input input-bordered w-full" required value="{{ old('name') }}" />
                @error('name')
                    <label class="label">
                        <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label" for="password">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" name="password" id="password" placeholder="Enter password" class="input input-bordered w-full" required />
                @error('password')
                    <label class="label">
                        <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="pt-4 space-y-2">
                <button type="submit" class="btn btn-primary w-full">Log-in</button>
                <!-- <div class="divider">OR</div> -->
                <!-- <a href="{{ route('oauth.show') }}" class="btn btn-outline w-full gap-2">
                    Login via Google
                </a> -->
            </div>

            @error('oauth')
                <div class="alert alert-error shadow-sm mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ $message }}</span>
                </div>
            @enderror

            <div class="text-center mt-6">
                <span class="text-sm opacity-70">Don't have an account?</span>
                <a href="{{ route('registration.show') }}" class="link link-primary link-hover text-sm font-semibold ml-1">Register Account</a>
            </div>
        </form>
    </div>
</x-app>