<x-app-layout>
    <div class="min-h-screen overflow-hidden ptmsi-margin px-4 sm:px-6 lg:px-8 pb-20">

        {{-- Greeting --}}
        @php
            $hour = now()->format('H');
            $greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon' : 'Good Evening');
            $user = Auth::user();
        @endphp

        <div class="pt-16 pb-8 text-3xl sm:text-4xl font-extrabold text-[#003a8c] leading-tight animate-fade-in-up mt-12">
            👋 {{ $greeting }}, {{ $user->name ?? 'Admin' }}!
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <div class="bg-white rounded-2xl p-7 shadow-xl border border-blue-200 hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 flex flex-col items-center text-center">
                <div class="p-3 bg-green-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-[#003a8c] mb-2">Students Registered (<span class="text-blue-600">{{ now()->format('F Y') }}</span>)</h3>
                <p class="text-5xl font-extrabold text-green-700">{{ $monthlyRegisteredStudents }}</p>
            </div>

            <div class="bg-white rounded-2xl p-7 shadow-xl border border-blue-200 hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 flex flex-col items-center text-center">
                <div class="p-3 bg-blue-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2a4 4 0 014-4h12.356"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12V6a4 4 0 014-4h4a4 4 0 014 4v6m-6 0H6m6 0h4m-6 0h-4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-[#003a8c] mb-2">Total Students</h3>
                <p class="text-5xl font-extrabold text-blue-700">{{ $totalStudents }}</p>
            </div>

            <div class="bg-white rounded-2xl p-7 shadow-xl border border-blue-200 hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 flex flex-col items-center text-center">
                <div class="p-3 bg-red-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-[#003a8c] mb-2">Outstanding Fees</h3>
                <p class="text-5xl font-extrabold text-red-700">{{ $studentsWithOutstandingFees }}</p>
            </div>

            <div class="bg-white rounded-2xl p-7 shadow-xl border border-blue-200 hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 flex flex-col items-center text-center">
                <div class="p-3 bg-purple-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-[#003a8c] mb-2">Survey Participants</h3>
                <p class="text-5xl font-extrabold text-purple-700">{{ $studentsWithSurvey }}</p>
            </div>

            <div class="bg-white rounded-2xl p-7 shadow-xl border border-blue-200 hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 flex flex-col items-center text-center col-span-1 md:col-span-2 lg:col-span-1">
                <div class="p-3 bg-yellow-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-[#003a8c] mb-2">Most Enrolled Class</h3>
                @if ($mostEnrolledClass)
                    <p class="text-4xl font-extrabold text-blue-800">{{ $mostEnrolledClass->subject->name }}</p>
                @else
                    <p class="text-xl text-gray-500 italic">No enrolments yet</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
