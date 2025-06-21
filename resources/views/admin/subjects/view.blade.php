<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-[#003a8c] font-serif tracking-tight">
                    <i class="fas fa-user-graduate mr-3"></i>Students Enrolled in {{ $subject->name }}
                </h2>
                <div class="flex items-center mt-2 text-sm text-gray-600">
                    <span class="bg-blue-100 text-[#003a8c] px-3 py-1 rounded-full mr-3">
                        {{ $subject->level == 'secondary' ? 'Form ' . $subject->class_level : 'Standard ' . $subject->class_level }}
                    </span>
                    <span class="capitalize">{{ $subject->level }} School</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-8">
        @if(session('status'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-lg shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex justify-between items-center mt-24 mb-6">
            <div class="text-sm text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Total {{ $enrolments->count() }} student(s) enrolled
            </div>
            <form method="POST" action="{{ route('admin.subjects.deleteEnrolments', $subject->slug) }}" 
                  onsubmit="return confirm('Are you sure you want to delete all enrolments for {{ $subject->name }}? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-trash-alt mr-2"></i>Delete All Enrolments
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-blue-50">
            @if($enrolments->isEmpty())
                <div class="p-8 text-center">
                    <i class="fas fa-user-slash text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">
                        No students enrolled in this subject yet.
                    </p>
                    <p class="text-sm text-gray-400 mt-2">
                        Students will appear here once they enroll in {{ $subject->name }}.
                    </p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#003a8c] uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#003a8c] uppercase tracking-wider">
                                    Student Details
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#003a8c] uppercase tracking-wider">
                                    Contact Information
                                </th>
                                <th scope="col" class="px-14 py-3 text-right text-xs font-medium text-[#003a8c] uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($enrolments as $i => $enrolment)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $i + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $enrolment->user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <div class="flex items-center mb-1">
                                                <i class="fas fa-envelope text-gray-400 mr-2 w-4"></i>
                                                {{ $enrolment->user->email }}
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fas fa-phone text-gray-400 mr-2 w-4"></i>
                                                {{ $enrolment->user->phone ?? 'Not provided' }}
                                            </div>
                                        </div>
                                    </td>
                                     <td class="px-8 py-4 whitespace-nowrap text-right text-sm font-medium">
    <a href="{{ route('admin.view', $enrolment->user->id) }}" 
       class="inline-flex items-center gap-2 px-5 py-2 rounded-xl shadow-md bg-[#003a8c] text-yellow-300 
              hover:bg-yellow-300 hover:text-[#003a8c] transition-colors text-sm font-semibold">
        <i class="fas fa-users"></i> View Info
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