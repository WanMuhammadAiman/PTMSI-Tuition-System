<nav x-data="{ open: false, profileOpen: false }" class="absolute top-6 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-2xl px-4 sm:px-0">
    <div class="relative">
        <div class="bg-[#003a8c] text-yellow-200 px-6 py-3 rounded-2xl shadow-xl flex items-center justify-between transition-all duration-300 ease-in-out"
             :class="{ 'rounded-b-none': open || profileOpen }">

            <button @click="open = !open; profileOpen = false" class="flex items-center gap-2 hover:text-white focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50 rounded-md p-1 -ml-1 transition duration-200">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <span class="text-lg font-semibold hidden sm:inline">Menu</span>
            </button>

            <div class="text-2xl sm:text-3xl font-extrabold tracking-wider">
                <a href="{{ route('student.dashboard') }}" class="hover:text-white transition duration-200">PTMSI</a>
            </div>

            <div class="relative">
                <button @click="profileOpen = !profileOpen; open = false" class="flex items-center gap-2 hover:text-white focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50 rounded-md p-1 -mr-1 transition duration-200">
                    <span class="text-lg font-semibold hidden sm:inline">{{ Auth::user()->name }}</span>
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.938 13.938 0 0112 15c2.21 0 4.29.523 6.121 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 max-h-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 max-h-[500px] transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 max-h-[500px] transform translate-y-0"
             x-transition:leave-end="opacity-0 max-h-0 transform -translate-y-2"
             @click.away="open = false"
             class="absolute top-full left-0 right-0 bg-[#003a8c] text-yellow-200 rounded-b-2xl shadow-xl z-40 px-6 py-5 space-y-4 text-lg font-semibold overflow-hidden border-t border-blue-700">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                <div>
                    <ul class="space-y-3">
                        {{-- Dashboard --}}
                        @php
                            $user = auth()->user();
                            $dashboardRoute = match($user->role) {
                                'admin' => route('admin.dashboard'),
                                'tutor' => route('tutor.dashboard'),
                                default => route('student.dashboard'),
                            };
                        @endphp
                        <li><a href="{{ $dashboardRoute }}" class="block p-2 rounded-lg hover:bg-[#0055c4] hover:text-white transition duration-200">Dashboard</a></li>

                        {{-- Include role-specific links --}}
                        @include('components.role-menu')

                        {{-- Auth-based content (Student-specific) --}}
                        @php
                            $hasEnrolments = \App\Models\Enrolment::where('user_id', auth()->id())->exists();
                            $hasPayments = \App\Models\Payment::where('user_id', auth()->id())->exists();
                        @endphp

                        @if ($hasEnrolments)
                            {{-- Classes --}}
                            <li x-data="{ subOpen: false }" class="relative">
                                <button @click="subOpen = !subOpen" class="flex items-center justify-between w-full p-2 rounded-lg hover:bg-[#0055c4] hover:text-white focus:outline-none transition duration-200">
                                    <span>Classes</span>
                                    <svg class="w-5 h-5 transform transition-transform duration-200" :class="{ 'rotate-180': subOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul x-show="subOpen" x-transition @click.away="subOpen = false" class="mt-2 ml-4 space-y-2 text-yellow-300 border-l border-yellow-300 pl-4">
                                    <li><a href="{{ route('enrolment.page') }}" class="block hover:text-white transition duration-200">Edit Subjects</a></li>
                                    <li><a href="{{ route('student.timetable') }}" class="block hover:text-white transition duration-200">View Timetable</a></li>
                                    <li><a href="{{ route('student.materials.index') }}" class="block hover:text-white transition duration-200">View Materials</a></li>
                                </ul>
                            </li>

                            {{-- Payment --}}
                            <li x-data="{ subOpen: false }" class="relative">
                                <button @click="subOpen = !subOpen" class="flex items-center justify-between w-full p-2 rounded-lg hover:bg-[#0055c4] hover:text-white focus:outline-none transition duration-200">
                                    <span>Payment</span>
                                    <svg class="w-5 h-5 transform transition-transform duration-200" :class="{ 'rotate-180': subOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <ul x-show="subOpen" x-transition @click.away="subOpen = false" class="mt-2 ml-4 space-y-2 text-yellow-300 border-l border-yellow-300 pl-4">
                                    <li><a href="{{ route('student.payment') }}" class="block hover:text-white transition duration-200">Make Payment</a></li>
                                    @if ($hasPayments)
                                        <li><a href="{{ route('student.payment.history') }}" class="block hover:text-white transition duration-200">Payment History</a></li>
                                    @endif
                                </ul>
                            </li>

                            {{-- Survey --}}
                            @php
                                $studentLevel = auth()->user()->form ?? null;
                            @endphp

                            @if (in_array($studentLevel, ['Form 4', 'Form 5']))
                                <li>
                                    <a href="{{ route('student.survey') }}" class="block p-2 rounded-lg hover:bg-[#0055c4] hover:text-white transition duration-200">Career Survey</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>

            <div class="text-right pt-4 border-t border-blue-700 mt-4">
                <button @click="open = false" class="text-sm font-bold text-yellow-300 hover:text-white transition duration-200 px-4 py-2 rounded-full border border-yellow-300 hover:border-white">CLOSE</button>
            </div>
        </div>

        <div x-show="profileOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 max-h-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 max-h-[500px] transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 max-h-[500px] transform translate-y-0"
             x-transition:leave-end="opacity-0 max-h-0 transform -translate-y-2"
             @click.away="profileOpen = false"
             class="absolute top-full right-0 mt-1 w-64 bg-[#003a8c] text-yellow-200 rounded-2xl shadow-xl z-40 p-6 space-y-4 text-base font-semibold border border-blue-700">

            <a href="{{ route('profile.edit') }}" class="block text-center p-2 rounded-lg hover:bg-[#0055c4] hover:text-white transition duration-200">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profile
                </span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="w-full text-center p-2 rounded-lg hover:bg-[#0055c4] hover:text-white transition duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Log Out
                </button>
            </form>

            <div class="border-t border-blue-700 pt-4 text-center">
                <button @click="profileOpen = false"
                        class="px-5 py-2 bg-white text-[#003a8c] rounded-full font-bold hover:bg-yellow-300 hover:text-[#002a6c] shadow-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-75">
                    Close
                </button>
            </div>
        </div>
    </div>
</nav>