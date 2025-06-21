<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-[#003a8c] font-serif">My Subjects</h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6 mt-24">
        @foreach($subjects as $subject)
            <a href="{{ route('student.materials.subject', $subject->id) }}"
               class="block bg-[#003a8c] text-yellow-300 p-4 rounded-xl hover:bg-[#002766]">
                {{ $subject->name }}
            </a>
        @endforeach
    </div>
</x-app-layout>
