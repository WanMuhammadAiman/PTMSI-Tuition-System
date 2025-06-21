<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-[#003a8c] font-serif">
            {{ __('Primary Level Subjects') }}
        </h2>
        <p class="mt-2 text-gray-600">Select a standard to manage subject materials.</p>
    </x-slot>

    <div class="min-h-[calc(100vh-150px)] ptmsi-margin px-6 py-12" x-data="{ selectedStandard: null }">
        <!-- Standard Dropdown -->
        <div class="max-w-md mb-10">
            <label for="standard" class="block text-sm font-medium text-gray-700 mb-1">Select Standard:</label>
            <select id="standard" x-model="selectedStandard" class="w-full border-gray-300 rounded-lg shadow-sm">
                <option value="">-- Select Standard --</option>
                @php
    $levels = $primarySubjects->pluck('class_level')->filter()->unique()->sort();
@endphp

@foreach($levels as $level)
    <option value="{{ $level }}">Standard {{ $level }}</option>
@endforeach

            </select>
        </div>

        <!-- Filtered Subjects -->
        <template x-if="selectedStandard">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($primarySubjects as $subject)
                    <template x-if="selectedStandard == '{{ $subject->class_level }}'">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-[#003a8c]/10 hover:shadow-xl transition-transform duration-300 hover:-translate-y-1">
                            <div class="bg-[#003a8c] text-yellow-300 p-4">
                                <h3 class="text-xl font-bold">{{ $subject->name }} - Standard {{ $subject->class_level }}</h3>
                            </div>
                            <div class="p-5">
                                <p class="text-gray-600 mb-4">{{ $subject->description ?? 'Explore learning materials for this subject and level.' }}</p>
                                <a href="{{ route('tutor.material.view', ['slug' => $subject->slug]) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-[#003a8c] text-yellow-300 hover:bg-yellow-300 hover:text-[#003a8c] rounded-lg font-medium transition-colors duration-300 shadow-md">
                                    Manage Materials
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </template>
                @endforeach
            </div>
        </template>

        <template x-if="selectedStandard === null">
            <p class="text-gray-500 text-sm mt-4">Please select a standard to view subjects.</p>
        </template>
    </div>
</x-app-layout>
