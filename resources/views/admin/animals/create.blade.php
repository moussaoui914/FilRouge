@extends('layouts.admin')

@section('title', 'Add New Animal - ZooQuarium')
@section('header', 'Add New Animal')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.animals.index') }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-800 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Animals
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800">Animal Information</h2>
            <p class="text-xs text-gray-500 mt-0.5">Fill in the details to add a new animal to the zoo</p>
        </div>

        <form action="{{ route('admin.animals.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Animal Name <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                            </svg>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('name') border-red-300 bg-red-50 @enderror"
                               placeholder="e.g., Simba, Ellie, George">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Species -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Species <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <input type="text" name="species" value="{{ old('species') }}" required
                               class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('species') border-red-300 bg-red-50 @enderror"
                               placeholder="e.g., Lion, Elephant, Giraffe">
                    </div>
                    @error('species')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Birth Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Birth Date <span class="text-gray-400 text-xs">(Optional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                               class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('birth_date') border-red-300 bg-red-50 @enderror">
                    </div>
                    @error('birth_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Health Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Health Status <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <select name="health_status" required
                                class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent appearance-none bg-white">
                            <option value="Excellent" {{ old('health_status') == 'Excellent' ? 'selected' : '' }}>Excellent</option>
                            <option value="Good" {{ old('health_status') == 'Good' ? 'selected' : '' }}>Good</option>
                            <option value="Fair" {{ old('health_status') == 'Fair' ? 'selected' : '' }}>Fair</option>
                            <option value="Poor" {{ old('health_status') == 'Poor' ? 'selected' : '' }}>Poor</option>
                            <option value="Critical" {{ old('health_status') == 'Critical' ? 'selected' : '' }}>Critical</option>
                        </select>
                    </div>
                    <div class="flex flex-wrap gap-3 mt-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-emerald-100 text-emerald-700">Excellent - Perfect health</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-green-100 text-green-700">Good - Normal health</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-yellow-100 text-yellow-700">Fair - Minor issues</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-orange-100 text-orange-700">Poor - Needs attention</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-rose-100 text-rose-700">Critical - Urgent care</span>
                    </div>
                    @error('health_status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Habitat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Habitat <span class="text-gray-400 text-xs">(Optional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <select name="habitat_id"
                                class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent appearance-none bg-white">
                            <option value="">-- Select Habitat --</option>
                            @foreach($habitats as $habitat)
                                <option value="{{ $habitat->id }}" {{ old('habitat_id') == $habitat->id ? 'selected' : '' }}>
                                    {{ $habitat->name }} ({{ $habitat->type }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('habitat_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Description <span class="text-gray-400 text-xs">(Optional)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                        </div>
                        <textarea name="description" rows="4" 
                                  class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('description') border-red-300 bg-red-50 @enderror"
                                  placeholder="Enter a description about the animal...">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Animal Image <span class="text-gray-400 text-xs">(Optional)</span>
                    </label>
                    <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 text-center hover:border-emerald-400 transition">
                        <input type="file" name="image" accept="image/*" id="imageInput" class="hidden">
                        <label for="imageInput" class="cursor-pointer">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 text-sm">Click to upload an image</p>
                            <p class="text-gray-400 text-xs mt-1">PNG, JPG, JPEG up to 2MB</p>
                        </label>
                    </div>
                    <div id="imagePreview" class="mt-3 hidden">
                        <img id="preview" class="w-32 h-32 object-cover rounded-lg shadow">
                        <button type="button" onclick="clearImage()" class="text-red-500 text-xs mt-1">Remove image</button>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Information Box -->
                <div class="bg-blue-50 rounded-lg p-4 border border-blue-100">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium text-blue-800 text-sm">Important Information</h4>
                            <ul class="text-xs text-blue-700 mt-1 space-y-1">
                                <li>• All animals require a unique name within the zoo</li>
                                <li>• Health status should be updated regularly by veterinary staff</li>
                                <li>• Images should be clear and show the animal prominently</li>
                                <li>• Add detailed description for better visitor experience</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.animals.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create Animal
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview').src = event.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    function clearImage() {
        document.getElementById('imageInput').value = '';
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('preview').src = '';
    }
</script>
@endsection