<x-app-layout>

    <div class="min-h-screen overflow-hidden ptmsi-margin px-4 sm:px-6 lg:px-8 pb-20">

        {{-- Greeting --}}
        @php
            $hour = now()->format('H');
            $greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon' : 'Good Evening');
        @endphp

        <div class="pt-16 pb-8 text-3xl sm:text-4xl font-extrabold text-[#003a8c] leading-tight animate-fade-in-up mt-12">
            👋 {{ $greeting }}, {{ $user->name ?? 'Tutor' }}!
        </div>

        {{-- Upload Quick Actions --}}
        <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
            <a href="{{ route('tutor.materials.primary') }}" class="flex flex-col items-center justify-center bg-white p-10 rounded-2xl shadow-lg border border-blue-200 hover:shadow-2xl transition transform hover:-translate-y-1">
                <div class="bg-yellow-100 p-5 rounded-full mb-4">
                    <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#003a8c]">Upload Primary Materials</h3>
            </a>

            <a href="{{ route('tutor.materials.secondary') }}" class="flex flex-col items-center justify-center bg-white p-10 rounded-2xl shadow-lg border border-blue-200 hover:shadow-2xl transition transform hover:-translate-y-1">
                <div class="bg-yellow-100 p-5 rounded-full mb-4">
                    <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-[#003a8c]">Upload Secondary Materials</h3>
            </a>
        </div>

        {{-- Recent Uploads --}}
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-[#003a8c] mb-6">Your Recent Uploads</h2>

            @if($recentMaterials->isEmpty())
                <div class="bg-white p-6 rounded-xl shadow text-center text-gray-600">
                    You have not uploaded any materials yet.
                </div>
            @else
                <div class="space-y-4">
                    @foreach($recentMaterials as $material)
                        <div class="flex justify-between items-center bg-white p-5 rounded-xl shadow border border-blue-100">
                            <div>
                                <p class="text-lg font-semibold text-[#003a8c]">{{ $material->subject }}</p>
                                @php
                                    $fileName = explode('_', $material->file_path, 2)[1] ?? $material->file_path;
                                @endphp
                                <p class="text-sm text-gray-600">{{ $fileName }}</p>
                            </div>
                            <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="text-blue-600 font-semibold hover:underline">
                                View
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
