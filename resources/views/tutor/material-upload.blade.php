<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-[#003a8c] font-serif tracking-tight">
            {{ __('Upload Class Materials') }}
        </h2>
        <p class="mt-2 text-gray-600">Select the educational level to manage materials</p>
    </x-slot>

    <div class="min-h-[calc(100vh-100px)] flex items-center justify-center px-6 max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Primary Card -->
            <a href="{{ route('tutor.materials.primary') }}"
               class="group relative bg-gradient-to-br from-[#003a8c] to-[#002766] text-yellow-300 hover:shadow-2xl transition-all duration-500 rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8 flex flex-col h-full">
                    <div class="z-10 relative">
                        <h3 class="text-2xl font-bold font-serif mb-4">Primary</h3>
                        <p class="text-yellow-100 opacity-90">Upload or manage notes for Primary level students.</p>
                    </div>
                    <div class="mt-6 text-right z-10 relative">
                        <span class="inline-flex items-center text-sm font-semibold group-hover:translate-x-2 transition-transform duration-300">
                            Go to Primary 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/always-grey.png')] opacity-10"></div>
            </a>

            <!-- Secondary Card -->
            <a href="{{ route('tutor.materials.secondary') }}"
               class="group relative bg-gradient-to-br from-[#003a8c] to-[#002766] text-yellow-300 hover:shadow-2xl transition-all duration-500 rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8 flex flex-col h-full">
                    <div class="z-10 relative">
                        <h3 class="text-2xl font-bold font-serif mb-4">Secondary</h3>
                        <p class="text-yellow-100 opacity-90">Upload or manage notes for Secondary level students.</p>
                    </div>
                    <div class="mt-6 text-right z-10 relative">
                        <span class="inline-flex items-center text-sm font-semibold group-hover:translate-x-2 transition-transform duration-300">
                            Go to Secondary 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/always-grey.png')] opacity-10"></div>
            </a>
        </div>
        
        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-full h-48 bg-gradient-to-b from-[#003a8c]/10 to-transparent -z-10"></div>
    </div>
</x-app-layout>