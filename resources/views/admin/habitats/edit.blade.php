@extends('layouts.app')

@section('title', 'Edit Habitat - ZooQuarium')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Habitat: {{ $habitat->name }}</h1>

            <form action="{{ route('admin.habitats.update', $habitat) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    @if($habitat->image)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                        <img src="{{ Storage::url($habitat->image) }}" alt="{{ $habitat->name }}" class="w-32 h-32 object-cover rounded-lg">
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Habitat Name *</label>
                        <input type="text" name="name" value="{{ old('name', $habitat->name) }}" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type *</label>
                        <select name="type" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">
                            <option value="Savanna" {{ old('type', $habitat->type) == 'Savanna' ? 'selected' : '' }}>Savanna</option>
                            <option value="Forest" {{ old('type', $habitat->type) == 'Forest' ? 'selected' : '' }}>Forest</option>
                            <option value="Aquatic" {{ old('type', $habitat->type) == 'Aquatic' ? 'selected' : '' }}>Aquatic</option>
                            <option value="Desert" {{ old('type', $habitat->type) == 'Desert' ? 'selected' : '' }}>Desert</option>
                            <option value="Tundra" {{ old('type', $habitat->type) == 'Tundra' ? 'selected' : '' }}>Tundra</option>
                            <option value="Mountain" {{ old('type', $habitat->type) == 'Mountain' ? 'selected' : '' }}>Mountain</option>
                            <option value="Tropical" {{ old('type', $habitat->type) == 'Tropical' ? 'selected' : '' }}>Tropical</option>
                        </select>
                        @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Capacity *</label>
                        <input type="number" name="capacity" value="{{ old('capacity', $habitat->capacity) }}" required min="1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">
                        @error('capacity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <input type="text" name="location" value="{{ old('location', $habitat->location) }}" 
                               placeholder="e.g., Zone A, North Section"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">
                        @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">{{ old('description', $habitat->description) }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Update Image</label>
                        <input type="file" name="image" accept="image/*" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>
                        @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('admin.habitats.index') }}" 
                           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-zoo-600 text-white rounded-lg hover:bg-zoo-700 transition">
                            Update Habitat
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
