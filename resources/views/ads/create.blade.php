@extends("layouts.app")

@section('content')
    <div class="flex justify-center items-center p-6">
        <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data"
            class="min-w-80 max-w-lg p-6 bg-white shadow-md rounded-md space-y-4">
            @csrf

            <h2 class="text-2xl font-bold mb-4">Create Ad</h2>

            {{-- Title --}}
            <div>
                <label for="title" class="block font-medium">Title</label>
                <x-forms.input class="w-full" type="text" name="title" value="{{ old('title') }}" maxlength="255"
                    required />
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block font-medium">Description</label>
                <x-forms.textarea class="w-full rounded-md" name="description" maxlength="2048"
                    required>{{ old('description') }}</x-forms.textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Price --}}
            <div>
                <label for="price" class="block font-medium">Price (optional)</label>
                <x-forms.input class="w-full" type="number" name="price" value="{{ old('price') }}" min="0"
                    max="999999999" />
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- City --}}
            <div>
                <label for="city" class="block font-medium">City</label>
                <x-forms.input class="w-full" type="text" name="city" value="{{ old('city') }}" maxlength="255" required />
                @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Address --}}
            <div>
                <label for="address" class="block font-medium">Address</label>
                <x-forms.input class="w-full" type="text" name="address" value="{{ old('address') }}" maxlength="255"
                    required />
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label for="category_id" class="block font-medium">Category</label>
                <select name="category_id" id="category_id" required
                    class="w-full mt-1 p-2 border rounded @error('category_id') border-red-500 @enderror">
                    <option value="">-- Select a category --</option>
                    @foreach ($categories as $category)
                        <optgroup label="{{ $category->name }}">
                            @foreach ($category->subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}" {{ old('category_id') == $subCategory->id ? 'selected' : '' }}>
                                    {{ $subCategory->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="images" class="block font-medium">Upload Images (up to 3)</label>
                <input type="file" name="images[]" multiple accept="image/*"
                    class="w-full mt-1 p-2 border rounded @error('images') border-red-500 @enderror">
                @error('images')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div>
                <x-forms.button type="submit" class="w-full rounded-md">
                    Create
                </x-forms.button>
            </div>
        </form>


    </div>
@endsection