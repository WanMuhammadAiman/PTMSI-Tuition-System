<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-[#003a8c] to-[#002766] py-6 px-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-yellow-300 font-serif tracking-wide">Your Career Survey Results</h2>
            <p class="text-yellow-200 mt-2">Discover your ideal career path</p>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-24">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-[#003a8c]/20">
            <div class="p-8 space-y-8">
                @if ($recommendation)
                <!-- Main Recommendation -->
                <div class="bg-gradient-to-r from-[#003a8c]/10 to-yellow-50 p-6 rounded-lg border-l-8 border-[#003a8c]">
                    <div class="flex items-start">
                        <div class="bg-[#003a8c] text-yellow-300 rounded-full p-3 mr-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 uppercase tracking-wider font-semibold">Recommended Career Field</p>
                            <h3 class="text-3xl font-bold text-[#003a8c] mt-1">{{ $recommendation['title'] }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Career Suggestions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Careers Card -->
                    <div class="bg-white border border-[#003a8c]/20 rounded-lg p-5 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-4">
                            <div class="bg-[#003a8c] text-yellow-300 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-[#003a8c]">Potential Careers</h4>
                        </div>
                        <ul class="space-y-2">
                            @foreach ($recommendation['careers'] as $career)
                            <li class="flex items-start">
                                <span class="text-yellow-500 mr-2">•</span>
                                <span class="text-gray-700">{{ $career }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Skills Card -->
                    <div class="bg-white border border-[#003a8c]/20 rounded-lg p-5 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-4">
                            <div class="bg-[#003a8c] text-yellow-300 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-[#003a8c]">Skills to Develop</h4>
                        </div>
                        <ul class="space-y-2">
                            @foreach ($recommendation['skills'] as $skill)
                            <li class="flex items-start">
                                <span class="text-yellow-500 mr-2">•</span>
                                <span class="text-gray-700">{{ $skill }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Courses Card -->
                    <div class="bg-white border border-[#003a8c]/20 rounded-lg p-5 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-4">
                            <div class="bg-[#003a8c] text-yellow-300 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-[#003a8c]">Courses to Explore</h4>
                        </div>
                        <ul class="space-y-2">
                            @foreach ($recommendation['courses'] as $course)
                            <li class="flex items-start">
                                <span class="text-yellow-500 mr-2">•</span>
                                <span class="text-gray-700">{{ $course }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                @else
                <!-- No Recommendation -->
                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-red-800">Recommendation Not Available</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <p>We couldn't determine a specific recommendation based on your answers. Consider retaking the survey or consulting with a career advisor.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Score Breakdown -->
                <div class="mt-10">
                    <h4 class="text-xl font-bold text-[#003a8c] border-b-2 border-[#003a8c]/30 pb-2 mb-4">Your Score Breakdown</h4>
                    
                    <div class="space-y-4">
                        @foreach ($scores as $category => $score)
                        <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg hover:bg-[#003a8c]/5 transition-colors duration-200">
                            <span class="font-medium text-gray-700 text-lg">{{ $category }}</span>
                            <div class="flex items-center">
                                <div class="w-32 bg-gray-200 rounded-full h-3 mr-4">
                                    <div class="bg-[#003a8c] h-3 rounded-full" style="width: {{ ($score/max($scores))*100 }}%"></div>
                                </div>
                                <span class="font-bold text-[#003a8c]">{{ $score }} point{{ $score > 1 ? 's' : '' }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->


                <div class="mt-12 flex justify-center">
    <a href="#" onclick="window.print()" class="px-6 py-3 bg-[#003a8c] text-yellow-300 rounded-lg font-semibold hover:bg-[#002766] transition-colors text-center shadow-md hover:shadow-lg">
        Download Full Report
    </a>
</div>

            </div>
        </div>
    </div>
</x-app-layout>
