<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-[#003a8c] font-serif">
                {{ __('Student Management') }}
            </h2>
            <div class="flex space-x-2">
                <x-primary-button class="bg-[#003a8c] hover:bg-[#002766] text-yellow-300 font-serif">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                    </svg>
                    Add Student
                </x-primary-button>
                <x-secondary-button class="bg-yellow-300 hover:bg-yellow-400 text-[#003a8c] font-serif">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Export
                </x-secondary-button>
            </div>
        </div>
    </x-slot>

    <div class="mt-16 py-8 px-4 sm:px-6 lg:px-8 font-serif">
        <div class="bg-gradient-to-b from-yellow-50 via-blue-100 to-blue-200 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-10">
                <form method="GET" action="{{ route('admin.index') }}" class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                    <div class="relative w-full sm:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-[#003a8c]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:ring-yellow-500 focus:border-yellow-500" placeholder="Search students...">
                    </div>

                    <div class="flex space-x-2">
                        <select name="level" class="border-gray-300 rounded-lg text-sm focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="">All Levels</option>
                            <option value="primary" {{ request('level') == 'primary' ? 'selected' : '' }}>Primary</option>
                            <option value="secondary" {{ request('level') == 'secondary' ? 'selected' : '' }}>Secondary</option>
                        </select>

                        <select name="sort" class="border-gray-300 rounded-lg text-sm focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="">Sort by Name</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                            <option value="level" {{ request('sort') == 'level' ? 'selected' : '' }}>Sort by Level</option>
                            <option value="class" {{ request('sort') == 'class' ? 'selected' : '' }}>Sort by Class</option>
                        </select>

                        <button type="submit" class="px-4 py-2 bg-[#003a8c] text-yellow-300 rounded-lg hover:bg-[#002766] font-serif text-sm">Apply</button>
                    </div>
                </form>


                <!-- TABLE GOES HERE -->
                <!-- Your existing student table and pagination can follow here -->
                <!-- No changes needed to the table code -->
                <div class="overflow-x-auto rounded-lg border border-gray-200 bg-white">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-[#003a8c] text-yellow-300">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Level</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Class</th>
                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($students as $index => $student)
                <tr class="hover:bg-blue-50 transition-colors duration-150">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + $students->firstItem() }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $student->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $student->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $student->phone ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($student->level) ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $student->level === 'primary' ? $student->standard : $student->form ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-right text-sm">
                        <a href="{{ route('admin.view', $student->id) }}" class="text-[#003a8c] hover:underline font-medium flex items-center justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No students found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

                {{ $students->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
