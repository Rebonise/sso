<x-guest-layout>
    <div class="flex items-center justify-center w-full min-h-screen bg-cover py-8" style="background-image: url(&quot;https://picsum.photos/id/314/1280/600&quot;);">
        <div class="max-w-md mx-auto w-full">
            <div class="card bg-white py-8 px-6 rounded w-full">
                <div class="flex justify-center">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500 mb-8" />
                    </a>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="flex flex-col form-control">
                        <label class="label" for="name">
                            <span class="label-text">Name</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="input input-bordered" autofocus required />
                    </div>

                    <div class="flex flex-col form-control mt-4">
                        <label class="label" for="email">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="input input-bordered" autofocus required />
                    </div>

                    <div class="flex flex-col form-control mt-4">
                        <label for="password" class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" name="password" id="password" class="input input-bordered" required />
                    </div>

                    <div class="flex flex-col form-control mt-4">
                        <label for="password_confirmation" class="label">
                            <span class="label-text">Confirm Password</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="input input-bordered" required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <button type="submit" class="btn btn-primary ml-4">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>