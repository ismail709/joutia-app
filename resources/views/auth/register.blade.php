@extends("layouts.app")

@section('content')
    <div class="flex justify-center items-center p-6">
        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data"
            class="min-w-80 max-w-lg p-6 bg-white shadow-md rounded-mg space-y-4">
            @csrf

            <h2 class="text-2xl font-bold mb-4">Register</h2>

            <!-- Name -->
            <div>
                <label for="name" class="block font-medium">Name</label>
                <x-forms.input class="w-full" type="text" name="name" value="{{ old('name') }}" required />
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block font-medium">Email</label>
                <x-forms.input class="w-full" type="email" name="email" value="{{ old('email') }}" required />
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

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block font-medium">Confirm Password</label>
                <x-forms.input class="w-full" type="password" name="password_confirmation" required />
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone_number" class="block font-medium">Phone Number</label>
                <x-forms.input class="w-full" type="text" name="phone_number" value="{{ old('phone_number') }}" required />
                @error('phone_number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Profile Image -->
            <div>
                <label for="profile_img" class="block font-medium">Profile Image (optional)</label>
                <input type="file" name="profile_img" id="profile_img"
                    class="w-full mt-1 p-2 border rounded @error('profile_img') border-red-500 @enderror" accept="image/*">
                @error('profile_img')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div>
                <x-forms.button type="submit" class="w-full rounded-md">
                    Register
                </x-forms.button>
            </div>
        </form>
    </div>

@endsection