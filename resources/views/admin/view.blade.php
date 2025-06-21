<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-[#003a8c] font-serif">Student Profile</h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 font-serif mt-24">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 overflow-hidden shadow-xl sm:rounded-lg border border-[#003a8c]/20">
            <!-- Student Header -->
            <div class="bg-[#003a8c] px-6 py-4 text-white flex items-center space-x-4">
                <div class="bg-yellow-300 text-[#003a8c] p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold">{{ $student->name }}</h3>
                    <p class="text-blue-100">{{ $student->email }}</p>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- Personal Information -->
                <div class="bg-white p-5 rounded-lg shadow border-l-4 border-[#003a8c]">
                    <h3 class="text-lg font-semibold text-[#003a8c] mb-3">Personal Information</h3>
                    <div class="space-y-3 text-gray-700">
                        <div class="flex">
                            <span class="w-24 text-gray-600">Phone:</span>
                            <span>{{ $student->phone ?? 'Not provided' }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-24 text-gray-600">Level:</span>
                            <span>{{ ucfirst($student->level) }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-24 text-gray-600">Class:</span>
                            <span>{{ $student->level === 'primary' ? $student->standard : $student->form }}</span>
                        </div>
                    </div>
                </div>

                <!-- Subjects Section -->
                            <!-- Subjects Section -->
                            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-400">
                    <h3 class="text-xl font-semibold text-[#003a8c] mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                        </svg>
                        Subjects Enrolled
                    </h3>
                    
                    @if($student->enrolments->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($student->enrolments as $enrolment)
                                <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100 hover:shadow-md transition">
                                    <div class="flex items-center">
                                        <div class="bg-[#003a8c] text-yellow-300 p-2 rounded-full mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-[#003a8c]">{{ $enrolment->subject->name ?? 'N/A' }}</h4>
                                            <p class="text-sm text-gray-500">Enrolled {{ $enrolment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2 text-lg text-gray-600">This student has not enrolled in any subjects yet.</p>
                        </div>
                    @endif
                </div>

                <!-- Back Button -->
                <div class="flex justify-center">
                    <a href="{{ route('admin.index') }}" class="px-5 py-2 bg-[#003a8c] text-white rounded-lg hover:bg-[#002766] transition flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to Student List
                    </a>

                    <!-- Delete Profile Button -->
    <form action="{{ route('admin.deleteUser', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this profile?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 011-1h6a1 1 0 011 1v1h5a1 1 0 110 2h-1v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5H3a1 1 0 010-2h5V2zm2 5a1 1 0 00-2 0v7a1 1 0 002 0V7zm6 0a1 1 0 00-2 0v7a1 1 0 002 0V7z" clip-rule="evenodd" />
            </svg>
            Delete Profile
        </button>
    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>