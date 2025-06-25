<x-app-layout>
    <div class="max-w-6xl mx-auto pt-24 pb-10 px-4 sm:px-6"> <!-- Increased top padding -->
        <div class="text-center mb-12">
        
            <h2 class="text-4xl font-extrabold text-[#003a8c] mb-3 transform translate-y-10"> <!-- Moved down 12 units -->
                Weekly Timetable
            </h2>
            <div class="w-24 h-1 bg-yellow-300 mx-auto transform translate-y-12"></div> <!-- Moved down to match -->
        </div>

        @php
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            $timeSlots = $subjects->pluck('time')->unique()->sort()->values()->toArray();
            
            $subjectsByDayTime = [];
            foreach ($subjects as $subject) {
                $subjectsByDayTime[$subject->day][$subject->time][] = $subject->name;
            }
        @endphp

        <div class="overflow-hidden rounded-xl shadow-lg border border-[#003a8c]/20 mt-16"> <!-- Added margin-top -->
            <table class="min-w-full table-fixed border-collapse">
                <thead>
                    <tr class="bg-[#003a8c] text-yellow-300">
                        <th class="w-32 px-6 py-4 border-r border-[#003a8c]/50 font-bold text-lg">Time</th>
                        @foreach($days as $day)
                            <th class="px-6 py-4 border-r border-[#003a8c]/50 last:border-r-0 font-bold text-lg">{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($timeSlots as $index => $time)
                        <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-[#f7fafd]' }} hover:bg-[#e6f0fa] transition-colors duration-150">
                            <td class="px-6 py-4 border-r border-t border-[#003a8c]/20 text-[#003a8c] font-semibold whitespace-nowrap">
                                {{ $time }}
                            </td>
                            @foreach($days as $day)
                                <td class="px-4 py-3 border-r border-t border-[#003a8c]/20 last:border-r-0">
                                    @if(isset($subjectsByDayTime[$day][$time]))
                                        <div class="flex flex-col space-y-2">
                                            @foreach($subjectsByDayTime[$day][$time] as $subjName)
                                                <div class="bg-[#003a8c]/10 hover:bg-[#003a8c]/20 text-[#003a8c] px-4 py-2 rounded-lg shadow-sm font-medium text-sm transition-all duration-200 transform hover:scale-[1.02]">
                                                    {{ $subjName }}
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic text-sm">—</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
        <div class="mt-6 flex justify-center">
    <button onclick="window.print()"
            class="bg-[#003a8c] text-yellow-300 px-6 py-3 rounded-full hover:bg-yellow-300 hover:text-[#003a8c] transition shadow-lg text-lg font-semibold">
        Print / Save as PDF
    </button>
</div>

    </div>
</x-app-layout>