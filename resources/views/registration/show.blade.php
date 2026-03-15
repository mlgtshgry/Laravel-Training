<x-app>
    <x-slot:title>
        Create Player Account
    </x-slot:title>

    <div class="max-w-lg mx-auto">
        @if(session('success'))
            <div class="alert alert-success shadow-lg mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>New Account Created!</span>
            </div>
        @endif

        <form method="post" action="{{ route('registration.save') }}" class="space-y-4">
            @csrf
            
            <div class="form-control w-full">
                <label class="label" for="name">
                    <span class="label-text font-semibold">Player Name</span>
                </label>
                <input type="text" name="name" id="name" placeholder="Letters, numbers, - and _" class="input input-bordered w-full" required value="{{ old('name') }}"/>
                <label class="label">
                    <span class="label-text-alt opacity-70">Must be letters, numbers, - and _</span>
                </label>
                @error('name')
                    <label class="label">
                        <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label" for="email">
                    <span class="label-text font-semibold">Email</span>
                </label>
                <input type="email" name="email" id="email" placeholder="example@email.com" class="input input-bordered w-full" required value="{{ old('email') }}" />
                @error('email')
                    <label class="label">
                        <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control w-full">
                    <label class="label" for="password">
                        <span class="label-text font-semibold">Password</span>
                    </label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="input input-bordered w-full" required />
                    @error('password')
                        <label class="label">
                            <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control w-full">
                    <label class="label" for="password_confirmation">
                        <span class="label-text font-semibold">Confirm Password</span>
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="input input-bordered w-full" required />
                    @error('password_confirmation')
                        <label class="label">
                            <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                        </label>
                    @enderror
                </div>
            </div>

            <div class="pt-6 flex flex-col gap-4">
                <button type="submit" class="btn btn-primary w-full">Create Account</button>
                <div class="text-center">
                    <span class="text-sm opacity-70">Already have an account?</span>
                    <a href="{{ route('login') }}" class="link link-primary link-hover text-sm font-semibold ml-1">Log in here</a>
                </div>
            </div>
        </form>
    </div>
</x-app>