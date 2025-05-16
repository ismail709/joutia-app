@extends("layouts.dashboard")

@section('profile')
    <section class="flex flex-col gap-4 p-4">
        <p class="text-2xl">Hello <span class="capitalize font-semibold">{{ $user->name }}</span> !</p>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 border-green-800 border p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="min-w-80 max-w-lg space-y-4">
            @csrf
            @method('PUT')

            <!-- Profile Image -->
            @if(isset($user->profile_img_path))
                <div class="w-24 h-24 rounded-full mx-auto overflow-hidden">
                    <img class="w-full h-full object-cover object-center" src="{{ asset($user->profile_img_path) }}" />
                </div>
            @endif
            <!-- Name -->
            <div>
                <label for="name" class="block font-medium">Name</label>
                <x-forms.input class="w-full" type="text" name="name" value="{{ old('name', $user->name) }}" required />
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block font-medium">Email</label>
                <x-forms.input class="w-full" type="email" name="email" value="{{ old('email', $user->email) }}" required />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone_number" class="block font-medium">Phone Number</label>
                <x-forms.input class="w-full" type="text" name="phone_number"
                    value="{{ old('phone_number', $user->phone_number) }}" required />
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
                    Update
                </x-forms.button>
            </div>
        </form>
    </section>
@endsection