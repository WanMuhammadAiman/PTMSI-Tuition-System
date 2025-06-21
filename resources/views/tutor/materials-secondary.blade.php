<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-[#003a8c] font-serif">
            {{ __('Secondary Level Subjects') }}
        </h2>
        <p class="mt-2 text-gray-600">Browse and manage materials organized by class level.</p>
    </x-slot>

    <div class="min-h-[calc(100vh-150px)] ptmsi-margin px-6 py-12">

        <!-- Dropdown filter -->
        <form method="GET" action="{{ route('tutor.materials.secondary') }}" class="mb-8">
            <label for="class_level" class="block font-semibold text-[#003a8c] mb-1">Filter by Form Level:</label>
            <select name="class_level" id="class_level" onchange="this.form.submit()" class="border border-[#003a8c]/40 p-2 rounded">
    <option value="">-- Show All --</option>
    @foreach ([1 => 'Form 1', 2 => 'Form 2', 3 => 'Form 3', 4 => 'Form 4', 5 => 'Form 5'] as $value => $label)
        <option value="{{ $value }}" {{ request('class_level') == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>

        </form>

        @if($secondarySubjects->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">No subjects found for the selected level.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($secondarySubjects as $subject)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-[#003a8c]/10 hover:shadow-xl transition-transform duration-300 hover:-translate-y-1">
                        <div class="bg-[#003a8c] text-yellow-300 p-4">
                            <h3 class="text-xl font-bold">{{ $subject->name }}</h3>
                        </div>
                        <div class="p-5">
                            <p class="text-gray-600 mb-4">
                                {{ $subject->description ?? 'Manage learning materials for this subject' }}
                            </p>
                            <a href="{{ route('tutor.secondary.materials.view', ['slug' => $subject->slug]) }}"
                               class="inline-flex items-center px-4 py-2 bg-[#003a8c] text-yellow-300 hover:bg-yellow-300 hover:text-[#003a8c] rounded-lg font-medium transition-colors duration-300 shadow-md">
                                Manage Materials
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>
