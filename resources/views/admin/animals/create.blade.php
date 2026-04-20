@extends('layouts.app')

@section('title', 'Add New Animal - ZooQuarium')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Add New Animal</h1>

            <form action="{{ route('admin.animals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Species *</label>
                        <input type="text" name="species" value="{{ old('species') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">
                        @error('species') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Birth Date</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">
                        @error('birth_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Health Status *</label>
                        <select name="health_status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">
                            <option value="Excellent">Excellent</option>
                            <option value="Good">Good</option>
                            <option value="Fair">Fair</option>
                            <option value="Poor">Poor</option>
                            <option value="Critical">Critical</option>
                        </select>
                        @error('health_status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Habitat</label>
                        <select name="habitat_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">
                            <option value="">None</option>
                            @foreach($habitats as $habitat)
                                <option value="{{ $habitat->id }}" {{ old('habitat_id') == $habitat->id ? 'selected' : '' }}>{{ $habitat->name }}</option>
                            @endforeach
                        </select>
                        @error('habitat_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-zoo-500 focus:border-zoo-500">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('admin.animals.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-zoo-600 text-white rounded-lg hover:bg-zoo-700">Create Animal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection