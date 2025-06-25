<nav x-data="{ open: false, profileOpen: false }" class="absolute top-6 left-1/2 transform -translate-x-1/2 z-50">
    <div class="relative">
        <!-- Combined Menu Bar and Dropdown Container -->
        <div class="w-[650px]">
            <!-- Main Menu Bar - Top Part -->
            <div class="bg-[#003a8c] text-yellow-300 px-6 py-3 rounded-t-2xl shadow-lg flex items-center gap-6 justify-between">
                <!-- Menu Button -->
                <button @click="open = !open; profileOpen = false" class="flex items-center gap-1 hover:text-white focus:outline-none">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span class="text-lg">Menu</span>
                </button>

                <!-- PTMSI Center Text -->
                <div class="text-2xl font-bold tracking-wide">
                <a href="{{ route('student.dashboard') }}" class="hover:text-white">PTMSI</a>
                </div>

                <!-- Profile Button -->
                <div class="relative">
                    <button @click="profileOpen = !profileOpen; open = false" class="flex items-center gap-1 hover:text-white focus:outline-none">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.938 13.938 0 0112 15c2.21 0 4.29.523 6.121 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-lg">{{ Auth::user()->name }}</span>
                    </button>
                </div>
            </div>

            <!-- Menu Dropdown - Integrated Bottom Part -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 max-h-0"
                 x-transition:enter-end="opacity-100 max-h-[500px]"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 max-h-[500px]"
                 x-transition:leave-end="opacity-0 max-h-0"
                 @click.away="open = false"
                 class="bg-[#003a8c] text-yellow-300 rounded-b-2xl shadow-lg px-6 py-4 space-y-4 text-lg font-semibold overflow-hidden">

                 <div class="grid grid-cols-2 gap-4">
                 <div>
    <ul class="space-y-2">
        <li>
            <a href="{{ route('student.dashboard') }}" class="hover:text-white">Dashboard</a>

            @include('components.role-menu')
            
        </li>

        @php
            $hasEnrolments = \App\Models\Enrolment::where('user_id', auth()->id())->exists();
        @endphp

        @if ($hasEnrolments)
            <li x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-1 hover:text-white focus:outline-none">
                    Classes
                    <svg class="w-4 h-4 transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <ul x-show="open" x-transition @click.away="open = false" class="mt-2 ml-2 space-y-2 text-yellow-300">
                    <li><a href="{{ route('enrolment.page') }}" class="hover:text-white">Edit Subjects</a></li>
                    <li><a href="{{ route('student.timetable') }}" class="hover:text-white">View Timetable</a></li>
                </ul>
            </li>

            <li x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-1 hover:text-white focus:outline-none">
                    Payment
                    <svg class="w-4 h-4 transform" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <ul x-show="open" x-transition @click.away="open = false" class="mt-2 ml-2 space-y-2 text-yellow-300">
                    <li><a href="{{ route('student.payment') }}" class="hover:text-white block">Make Payment</a></li>
                </ul>
            </li>
        @endif

    </ul>
</div>

</div>


                <div>
                    <button @click="open = false" class="text-sm hover:text-white">CLOSE</button>
                </div>

            </div>
        </div>

        <!-- Profile Dropdown - Separate as before -->
        <div x-show="profileOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             @click.away="profileOpen = false"
             class="absolute top-full right-0 w-[350px] bg-[#003a8c] text-yellow-300 rounded-2xl shadow-xl z-40 text-center px-6 py-8 space-y-6 text-lg font-semibold mt-1">

            <a href="{{ route('profile.edit') }}" class="block hover:text-white transition">Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full hover:text-white transition">Log Out</button>
            </form>

            <button @click="profileOpen = false"
                    class="mt-4 px-4 py-2 bg-white text-[#003a8c] rounded-full font-medium hover:bg-yellow-300 hover:text-[#003a8c] shadow transition">
                Close
            </button>
        </div>
    </div>
</nav>