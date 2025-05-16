@extends("layouts.app")

@section('content')
    <div class="flex justify-center items-center p-6">

        <form action="{{ route('login.store') }}" method="POST"
            class="min-w-80 max-w-lg p-6 bg-white shadow-md rounded-md space-y-4">
            @csrf

            <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

            <!-- Email -->
            <div>
                <label for="email" class="block font-medium">Email</label>
                <x-forms.input class="w-full" type="email" name="email" id="email" value="{{ old('email') }}" required autofocus />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block font-medium">Password</label>
                <x-forms.input class="w-full" type="password" name="password" required />
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div>
                <x-forms.button type="submit" class="w-full rounded-md">
                    Login
                </x-forms.button>
            </div>

            <!-- Forgot Password -->
            {{-- <div class="text-center mt-2">
                <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline text-sm">
                    Forgot your password?
                </a>
            </div> --}}
        </form>
    </div>

@endsection