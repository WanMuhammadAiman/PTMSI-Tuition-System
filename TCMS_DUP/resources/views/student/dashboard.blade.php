<x-app-layout>

@if(session('status') || session('error') || $errors->any())
<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-init="setTimeout(() => show = false, 4000)" 
    x-transition 
    class="fixed top-6 right-6 z-50 space-y-2"
>
    @if(session('status'))
    <div class="flex items-center px-5 py-3 rounded-xl shadow-lg bg-[#003a8c] text-yellow-200 space-x-3">
        <svg class="w-5 h-5 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-sm font-medium">{{ session('status') }}</span>
    </div>

    {{-- View Timetable Button --}}
    <div class="mt-2 text-right">
        <a href="{{ route('student.timetable') }}" class="inline-block px-4 py-2 bg-[#003a8c] text-yellow-300 rounded-full font-semibold shadow hover:bg-[#002a6c] transition">
            View Timetable
        </a>
    </div>

    @endif
</div>
@endif

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <div class="h-[100vh] overflow-hidden bg-gradient-to-b from-yellow-50 via-blue-100 to-blue-200 px-4 sm:px-6 lg:px-8">

        {{-- Greeting --}}
        @php
            $hour = now()->format('H');
            $greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon' : 'Good Evening');
        @endphp

        <div class="mt-20 text-2xl font-bold text-gray-800 dark:text-black animate-fade-in-up">
            👋 {{ $greeting }}, {{ Auth::user()->name ?? 'Student' }}!
        </div>

        @if (!$hasCompletedProfile)
            {{-- Profile Completion Gate --}}
            <div class="mt-10 max-w-2xl mx-auto bg-white rounded-2xl p-8 shadow-lg border border-[#003a8c]/20 animate-fade-in-up">
                <div class="flex justify-center mb-6">
                    <div class="bg-[#003a8c]/10 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#003a8c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-center text-[#003a8c] mb-3">
                    Complete Your Profile First
                </h2>

                <div class="bg-[#ffcc00]/10 border-l-4 border-[#ffcc00] p-4 mb-6">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#ffcc00] mt-0.5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="text-[#003a8c] font-medium">We need this information to:</p>
                            <ul class="list-disc list-inside text-[#003a8c]/90 mt-1 space-y-1">
                                <li>Determine your academic level</li>
                                <li>Show relevant subjects</li>
                                <li>Create your learning plan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-4 mt-6">
                    <a href="{{ route('profile.edit') }}" class="px-6 py-3 bg-[#003a8c] text-white rounded-full font-medium text-center shadow-md hover:bg-[#002a6c] transition flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Complete Profile Now
                    </a>

                    <button class="px-6 py-3 border border-[#003a8c] text-[#003a8c] rounded-full font-medium opacity-50 cursor-not-allowed flex items-center justify-center" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Enrol in Subjects
                    </button>
                </div>

                <div class="mt-6 text-center text-sm text-[#003a8c]/80">
                    <p>Subject enrollment will unlock after profile completion</p>
                </div>
            </div>

        @elseif (!$hasEnrolments)
            {{-- Show enrolment access if profile is complete but no enrolment yet --}}
            <div class="mt-10 max-w-2xl mx-auto bg-white rounded-2xl p-8 shadow-lg border border-[#003a8c]/20 animate-fade-in-up text-center">
                <h2 class="text-2xl font-bold text-[#003a8c] mb-3">You're All Set!</h2>
                <p class="text-gray-700">Now that your profile is complete, you can begin enrolling in subjects.</p>
                <a href="{{ route('enrolment.page') }}" class="mt-6 inline-block bg-[#003a8c] text-white px-6 py-3 rounded-full hover:bg-[#002a6c] transition">
                    Enrol in Subjects
                </a>
            </div>

        @else
            {{-- Full Dashboard --}}
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Timetable Card -->
                <div class="bg-gradient-to-br from-[#f0f4ff] to-[#e0eaff] rounded-2xl shadow p-6 transition-transform duration-300 hover:scale-105 hover:shadow-xl animate-fade-in-up">
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">📅 Timetable</h3>
                    <p class="text-gray-700 text-sm">Your next class is:</p>
                    <p class="font-bold text-sm mt-1">Mathematics - 2:00PM to 3:30PM</p>
                    <a href="#" class="text-sm text-blue-600 hover:underline mt-3 inline-block">View Full Timetable</a>
                </div>

                <!-- Empty Card -->
                <div class="bg-white rounded-2xl shadow p-6 transition-transform duration-300 hover:scale-105 hover:shadow-xl animate-fade-in-up">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">✨ More Coming Soon</h3>
                    <p class="text-sm text-gray-600">Stay tuned for new features!</p>
                </div>

                <!-- Outstanding Fees Card -->
                <div class="bg-gradient-to-br from-[#fff4f4] to-[#ffeaea] rounded-2xl shadow p-6 transition-transform duration-300 hover:scale-105 hover:shadow-xl animate-fade-in-up">
                    <h3 class="text-lg font-semibold text-red-700 mb-2">💸 Outstanding Fees</h3>
                    <p class="text-gray-700 text-sm">You have unpaid fees:</p>
                    <p class="font-bold text-sm mt-1">RM 120.00</p>
                    <a href="#" class="text-sm text-red-600 hover:underline mt-3 inline-block">Make a Payment</a>
                </div>

                <!-- Announcements Card -->
                <div class="col-span-2 bg-gradient-to-br from-[#fff9e6] to-[#fdf5cc] rounded-2xl shadow p-6 transition-transform duration-300 hover:scale-105 hover:shadow-xl animate-fade-in-up">
                    <h3 class="text-lg font-semibold text-yellow-700 mb-2">📢 Announcements</h3>
                    <p class="text-gray-700 text-sm">🎉 Hari Raya holiday on 8th May 2025. Classes resume on 9th.</p>
                    <a href="#" class="text-sm text-yellow-600 hover:underline mt-3 inline-block">See All Announcements</a>
                </div>

                <!-- Attendance Summary Card -->
                <div class="bg-gradient-to-br from-[#e6f7ec] to-[#c9f0d9] rounded-2xl shadow p-6 transition-transform duration-300 hover:scale-105 hover:shadow-xl animate-fade-in-up">
                    <h3 class="text-lg font-semibold text-green-700 mb-2">✅ Attendance Summary</h3>
                    <p class="text-gray-700 text-sm">This month:</p>
                    <ul class="text-sm mt-2 space-y-1 text-gray-800">
                        <li>✅ Attended: <strong>10</strong></li>
                        <li>❌ Missed: <strong>2</strong></li>
                        <li>📅 Total: <strong>12</strong></li>
                    </ul>
                    <a href="#" class="text-sm text-green-600 hover:underline mt-3 inline-block">View Detailed Record</a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
