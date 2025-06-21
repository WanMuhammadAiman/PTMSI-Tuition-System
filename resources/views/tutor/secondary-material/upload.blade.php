

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div class="bg-[#003a8c] p-3 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
    </x-slot>

    <div class="flex items-start justify-center min-h-[calc(100vh-120px)] px-6 pt-36">
    <div class="w-full max-w-4xl">

  

    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6 shadow-md">
        <div class="flex items-center justify-between">
            <!-- Left: Success message -->
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>

            <!-- Right: View Material button -->
            @if (session('material_subject_slug'))
                <a href="{{ route('tutor.secondary.materials.view', session('material_subject_slug')) }}"
                   class="text-sm bg-[#003a8c] text-yellow-300 hover:bg-yellow-300 hover:text-[#003a8c] px-4 py-2 rounded-lg font-semibold transition-all">
                    View Material →
                </a>
            @endif
        </div>
    </div>
@endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-[#003a8c] to-[#002766] p-4">
                <h3 class="text-lg font-bold text-yellow-300 font-serif">Material Upload Form</h3>
            </div>
            
            <form action="{{ route('tutor.secondary.material.upload') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                <input type="hidden" name="subject_id" value="{{ $subject->id }}">


                <div class="space-y-2">
                    <label for="material" class="block text-lg font-semibold text-[#003a8c] font-serif">Choose File</label>
                    <div x-data="{ fileName: '' }" class="mt-1 flex items-center w-full">
    <label
        for="material"
        class="flex flex-col items-center justify-center w-full p-8 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200"
    >
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#003a8c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            <p class="mb-2 text-sm text-gray-500">
                <span class="font-semibold">Click to upload</span> or drag and drop
            </p>
            <p class="text-xs text-gray-500">PDF, DOCX, PPTX (MAX. 10MB)</p>
            <p class="text-sm text-gray-700 font-medium mt-2" x-text="fileName"></p>
        </div>
        <input id="material" name="material" type="file" class="hidden" required
               @change="fileName = $event.target.files[0]?.name" />
    </label>
</div>

                    @error('material') 
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                <div class="flex justify-end">
    <button type="submit" class="flex items-center px-6 py-3 bg-[#003a8c] text-yellow-300 hover:bg-yellow-300 hover:text-[#003a8c] font-serif font-bold rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
        </svg>
        Upload Material
    </button>
</div>

            </form>
        </div>
    </div>
    </div>
</x-app-layout>