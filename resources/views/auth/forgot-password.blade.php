<x-guest-layout>
    <div class="flex items-center justify-center w-full min-h-screen bg-cover py-8" style="background-image: url(&quot;https://picsum.photos/id/314/1280/600&quot;);">
        <div class="max-w-md mx-auto w-full">
            <div class="card bg-white py-8 px-6 rounded w-full">
                <div class="flex justify-center">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500 mb-8" />
                    </a>
                </div>

                <div class="mb-4 text-sm">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="flex flex-col form-control">
                        <label class="label" for="email">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="input input-bordered" autofocus required />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="btn btn-primary ml-4">
                            {{ __('Email Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
