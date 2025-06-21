<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-[#003a8c] font-serif tracking-tight">
                <i class="fas fa-book-open mr-2"></i>Manage Students by Subject
            </h2>
        </div>
    </x-slot>

    <div class="py-6 px-8 mt-24">
        {{-- Filter Section --}}
        <div class="bg-white rounded-xl shadow-md border border-blue-50 p-6 mb-8">
            <h3 class="text-lg font-semibold text-[#003a8c] mb-4 flex items-center">
                <i class="fas fa-filter mr-2"></i>Filter Subjects
            </h3>
            
            <form method="GET" action="{{ route('admin.subjects.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-graduation-cap mr-1"></i>Academic Level
                    </label>
                    <select name="level" id="level" class="w-full rounded-lg border-gray-300 focus:border-[#003a8c] focus:ring-[#003a8c] shadow-sm" onchange="this.form.submit()">
                        <option value="">All Levels</option>
                        <option value="primary" {{ request('level') == 'primary' ? 'selected' : '' }}>Primary School</option>
                        <option value="secondary" {{ request('level') == 'secondary' ? 'selected' : '' }}>Secondary School</option>
                    </select>
                </div>

                <div>
                    <label for="class_level" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-layer-group mr-1"></i>Class Level
                    </label>
                    <select name="class_level" id="class_level" class="w-full rounded-lg border-gray-300 focus:border-[#003a8c] focus:ring-[#003a8c] shadow-sm" onchange="this.form.submit()">
                        <option value="">All Classes</option>
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}" {{ request('class_level') == $i ? 'selected' : '' }}>
                                {{ request('level') == 'secondary' ? 'Form ' . $i : 'Standard ' . $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- <div class="flex items-center">
                    <input type="checkbox" name="show_all" id="show_all" value="1" onchange="this.form.submit()" 
                           class="h-5 w-5 rounded border-gray-300 text-[#003a8c] focus:ring-[#003a8c]" 
                           {{ request('show_all') ? 'checked' : '' }}>
                    <label for="show_all" class="ml-2 block text-sm text-gray-700">
                        Show all subjects
                    </label>
                </div> -->

                <div class="w-full flex justify-end mt-4 mx-36">
    <a href="{{ route('admin.subjects.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200">
        <i class="fas fa-sync-alt mr-2"></i>Reset Filters
    </a>
</div>

            </form>
        </div>

        {{-- Subject Table --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-blue-50">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
                <h3 class="text-lg font-semibold text-[#003a8c]">
                    <i class="fas fa-list-ul mr-2"></i>Subject List
                </h3>
            </div>
            
            @if($subjects->isEmpty())
                <div class="p-8 text-center">
                    <i class="fas fa-book text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">
                        No subjects found{{ $classLevel ? ' for ' . $classLevel : '' }}.
                    </p>
                    <p class="text-sm text-gray-400 mt-2">
                        Try adjusting your filters or contact admin if you believe this is an error.
                    </p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#003a8c] uppercase tracking-wider">
                                    <i class="fas fa-bookmark mr-1"></i>Subject
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#003a8c] uppercase tracking-wider">
                                    Class Level
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-[#003a8c] uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($subjects as $subject)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-book text-[#003a8c]"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $subject->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-[#003a8c]">
                                            {{ $subject->level == 'secondary' ? 'Form ' . $subject->class_level : 'Standard ' . $subject->class_level }}
                                        </span>
                                    </td>
                                   <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
    <a href="{{ route('admin.subjects.view', $subject->slug) }}" 
       class="inline-flex items-center gap-2 px-5 py-2 rounded-xl shadow-md bg-[#003a8c] text-yellow-300 
              hover:bg-yellow-300 hover:text-[#003a8c] transition-colors text-sm font-semibold">
        <i class="fas fa-users"></i> View Students
    </a>
</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>