
<x-app-layout>

    @if(session('status') || session('error') || $errors->any())
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-6"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-6"
        class="fixed top-6 right-6 z-50 space-y-3"
    >
        @if(session('status'))
        <div class="flex items-center px-6 py-3 rounded-xl shadow-lg bg-[#003a8c] text-yellow-200 space-x-3 transform transition-transform duration-300 ease-out hover:scale-105">
            <svg class="w-6 h-6 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-base font-medium">{{ session('status') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="flex items-center px-6 py-3 rounded-xl shadow-lg bg-red-600 text-white space-x-3 transform transition-transform duration-300 ease-out hover:scale-105">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="text-base font-medium">{{ session('error') }}</span>
        </div>
        @endif

        {{-- View Timetable Button --}}
        <div class="mt-3 text-right">
            <a href="{{ route('student.timetable') }}" class="inline-block px-5 py-2.5 bg-[#003a8c] text-yellow-300 rounded-full font-semibold shadow-md hover:bg-[#002a6c] transition transform hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#003a8c] focus:ring-opacity-75">
                View Timetable
            </a>
        </div>
    </div>
    @endif

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="text-gray-800 font-sans mt-14 min-h-[calc(100vh-3.5rem)]">
        {{-- Greeting --}}
        @php
            $hour = now()->format('H');
            $greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon' : 'Good Evening');
            $user = Auth::user();
        @endphp

        <div class="pt-12 pb-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-[#003a8c] leading-tight">
                            👋 {{ $greeting }}, <span>{{ $user->name ?? 'Student' }}</span>!
                        </h1>
                    </div>
                    <!-- <div class="flex items-center space-x-3 bg-white px-5 py-2.5 rounded-full shadow-sm border border-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-base font-medium text-blue-800">{{ now()->format('l, F j, Y') }}</p>
                    </div> -->
                </div>
            </div>
        </div>

        {{-- Student-only content --}}
        @if ($user->role === 'student')
            @if (!$hasCompletedProfile)
                {{-- Profile Completion Gate --}}
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-blue-200">
                        <div class="bg-gradient-to-r from-[#003a8c] to-[#0055c4] p-8 text-center relative overflow-hidden">
                            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 100 100\'><circle cx=\'20\' cy=\'20\' r=\'15\' fill=\'%23ffffff\' opacity=\'0.1\'/><circle cx=\'80\' cy=\'50\' r=\'10\' fill=\'%23ffffff\' opacity=\'0.1\'/><circle cx=\'50\' cy=\'80\' r=\'12\' fill=\'%23ffffff\' opacity=\'0.1\'/></svg>');"></div>
                            <div class="relative z-10">
                                <div class="mx-auto w-24 h-24 bg-yellow-400/30 rounded-full flex items-center justify-center mb-5 border-2 border-yellow-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h2 class="text-3xl font-extrabold text-white mb-2">
                                    Complete Your Profile
                                </h2>
                                <p class="text-blue-100 text-lg">We need a few more details to personalize your learning experience.</p>
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-5 mb-8 rounded-r-lg shadow-sm">
                                <div class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600 mt-0.5 mr-4 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <h4 class="text-yellow-800 font-bold mb-2 text-lg">Why this information is vital:</h4>
                                        <ul class="list-disc list-inside text-yellow-700 text-base space-y-1">
                                            <li>Determine your academic level and subjects</li>
                                            <li>Create personalized learning plans tailored for you</li>
                                            <li>Connect you with the most appropriate tutors</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row justify-center gap-5 mt-8">
                                <a href="{{ route('profile.edit') }}" class="px-8 py-4 bg-gradient-to-r from-[#003a8c] to-[#0055c4] text-white rounded-xl font-bold text-lg text-center shadow-lg hover:from-[#002a6c] hover:to-[#003a8c] transition transform hover:-translate-y-1 hover:shadow-xl flex items-center justify-center min-w-[240px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Complete Profile Now
                                </a>
                            </div>

                            <div class="mt-8 text-center text-base text-blue-600/80">
                                <p>Subject enrollment will unlock immediately after your profile is complete.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif (!$hasEnrolments)
                {{-- Enrolment CTA --}}
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-blue-200">
                        <div class="bg-gradient-to-r from-[#003a8c] to-[#0055c4] p-8 text-center relative overflow-hidden">
                            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 100 100\'><path d=\'M0 0h100v100H0z\' fill=\'none\'/><circle cx=\'30\' cy=\'30\' r=\'18\' fill=\'%23ffffff\' opacity=\'0.1\'/><rect x=\'60\' y=\'10\' width=\'25\' height=\'25\' fill=\'%23ffffff\' opacity=\'0.1\' transform=\'rotate(45 72.5 22.5)\'/><path d=\'M20 70L40 90L60 70Z\' fill=\'%23ffffff\' opacity=\'0.1\'/></svg>');"></div>
                            <div class="relative z-10">
                                <div class="mx-auto w-24 h-24 bg-yellow-400/30 rounded-full flex items-center justify-center mb-5 border-2 border-yellow-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h2 class="text-3xl font-extrabold text-white mb-2">
                                    Ready to Enroll in Subjects
                                </h2>
                                <p class="text-blue-100 text-lg">Choose your subjects to ignite your learning adventure!</p>
                            </div>
                        </div>

                        <div class="p-8 text-center">
                            <p class="text-gray-700 mb-8 text-lg leading-relaxed">Now that your profile is complete, you can select the subjects you want to study and gain access to a world of knowledge.</p>
                            <a href="{{ route('enrolment.page') }}" class="inline-block px-10 py-4 bg-gradient-to-r from-[#003a8c] to-[#0055c4] text-white font-bold text-lg rounded-xl shadow-lg hover:from-[#002a6c] hover:to-[#003a8c] transition transform hover:-translate-y-1 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-[#003a8c] focus:ring-opacity-75">
                                Enroll in Subjects
                            </a>
                        </div>
                    </div>
                </div>
            @else
                {{-- Full Student Dashboard --}}
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 mt-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-blue-200 h-full flex flex-col">
                            <div class="bg-gradient-to-r from-[#003a8c] to-[#0055c4] p-5">
                                <h3 class="text-xl font-bold text-[#FFD700] flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Classes Today
                                </h3>
                            </div>
                            <div class="p-6 space-y-4 flex-grow">
                                @forelse ($todayClasses as $class)
                                    <div class="border border-blue-100 bg-blue-50 p-4 rounded-lg shadow-sm hover:shadow-md transition duration-200">
                                        <p class="text-lg font-bold text-gray-900 mb-1">{{ $class->name }}</p>
                                        <p class="text-sm text-gray-700 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $class->time }}
                                        </p>
                                    </div>
                                @empty
                                    <div class="bg-blue-50 p-5 rounded-lg text-center">
                                        <p class="text-base text-gray-600">You have no classes scheduled for today. Enjoy your day!</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-blue-200 h-full flex flex-col">
                            <div class="bg-gradient-to-r from-[#003a8c] to-[#0055c4] p-5">
                                <h3 class="text-xl font-bold text-[#FFD700] flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Payment Status
                                </h3>
                            </div>
                            <div class="p-6 text-center flex-grow flex flex-col justify-center items-center">
                                @if ($paymentStatus === 'Paid')
                                    <div class="text-green-600 bg-green-50 p-4 rounded-full inline-flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-4xl font-extrabold text-green-700 mb-3">Paid</p>
                                    <p class="text-base text-gray-700">Your payment for <span class="font-semibold">{{ now()->format('F Y') }}</span> has been successfully processed.</p>
                                @else
                                    <div class="text-red-600 bg-red-50 p-4 rounded-full inline-flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-4xl font-extrabold text-red-700 mb-3">Unpaid</p>
                                    <p class="text-base text-gray-700">Your payment for <span class="font-semibold">{{ now()->format('F Y') }}</span> is still pending.</p>
                                @endif
                                {{-- <a href="#" class="mt-5 inline-flex items-center text-base font-semibold text-red-600 hover:text-red-700 transition duration-200">
                                    Make payment
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a> --}}
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-blue-200 h-full flex flex-col">
                            <div class="bg-gradient-to-r from-[#003a8c] to-[#0055c4] p-5">
                                <h3 class="text-xl font-bold text-[#FFD700] flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0zM12 6v6l4 2" />
                                    </svg>
                                    Recent Materials
                                </h3>
                            </div>
                            <div class="p-6 flex-grow">
                                <div class="space-y-4">
                                    @forelse($recentMaterials as $material)
                                        <div class="flex items-center justify-between bg-blue-50 px-4 py-3 rounded-lg border border-blue-100 hover:shadow-md transition duration-200">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-base font-semibold text-blue-800 truncate mb-0.5">{{ $material->subject }}</p>
                                                @php
                                                    $fileName = explode('_', $material->file_path, 2)[1] ?? $material->file_path;
                                                @endphp
                                                <p class="text-sm text-gray-600 truncate">{{ $fileName }}</p>
                                            </div>
                                            <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="ml-4 flex-shrink-0 text-blue-600 hover:text-blue-800 transition duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="bg-blue-50 p-5 rounded-lg text-center">
                                            <p class="text-base text-gray-600">No recent study materials available at the moment.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>

</x-app-layout>
```