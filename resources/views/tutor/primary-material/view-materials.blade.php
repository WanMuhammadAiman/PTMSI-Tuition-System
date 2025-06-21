<x-app-layout>
    <x-slot name="header">
        <div class="pb-4 border-b border-[#003a8c]/20">
            <h2 class="text-3xl font-bold text-[#003a8c] font-serif">
                {{ $subject->name }} Learning Materials
            </h2>
            <p class="mt-2 text-gray-600">Manage and access all teaching resources for this subject</p>
        </div>
    </x-slot>

    <div class="px-4 sm:px-8 md:px-16 lg:px-24 py-6 space-y-8">
        @if ($materials->isEmpty())
        <div class="text-center mt-36 p-8 max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden border border-[#003a8c]/20 mt-12">
            <div class="bg-[#003a8c]/5 p-6 rounded-full inline-flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-[#003a8c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="mt-6">
                <h3 class="text-xl font-bold text-[#003a8c] font-serif">No Materials Found</h3>
                <p class="mt-2 text-gray-600">You haven't uploaded any resources for this subject yet</p>
             </div>
        </div>
        @else
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-[#003a8c]/10 mt-24">
                <!-- Title Bar -->
                <!-- Combined Title + Header Row (12-column grid) -->
                <div class="grid grid-cols-12 px-6 py-3 bg-[#003a8c] text-yellow-300 font-medium text rounded-t-xl">
    <!-- Icon + Title spans 6 columns -->
                    <div class="col-span-6 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-base font-semibold">Available Materials ({{ $materials->count() }})</span>
                    </div>

    <!-- Header Labels -->
    <div class="col-span-2 font-semibold">Uploaded</div>
    <div class="col-span-2 font-semibold">Type</div>
    <div class="col-span-2 font-semibold px-36">Action</div>
    </div>

                <!-- Material Rows -->
                <ul class="divide-y divide-[#003a8c]/10">
                    @foreach ($materials as $material)
                        @php
                            $fileUrl = asset('storage/' . $material->file_path);
                            $ext = strtolower(pathinfo($material->file_path, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                        @endphp

                        <li class="hover:bg-[#f8f9fa] transition">
                            <div class="grid grid-cols-12 items-center px-6 py-4">
                                <!-- File Preview + Name -->
                                <div class="col-span-6 flex items-center min-w-0">
                                    @if ($isImage)
                                        <img src="{{ $fileUrl }}" alt="Material Preview" class="h-12 w-12 rounded border border-gray-300 shadow-sm object-cover" />
                                    @else
                                        <div class="h-12 w-12 bg-[#003a8c] flex items-center justify-center rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="ml-4 min-w-0">
                                        <a href="{{ $fileUrl }}" 
                                           class="text-lg font-medium text-[#003a8c] hover:underline truncate block" 
                                           target="_blank"
                                           title="{{ basename($material->file_path) }}">
                                            {{ basename($material->file_path) }}
                                        </a>
                                    </div>
                                </div>

                                <!-- Upload Time -->
                                <div class="col-span-2 text-sm text-gray-500">
                                    {{ $material->created_at->diffForHumans() }}
                                </div>

                                <!-- File Type -->
                                <div class="col-span-2">
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                        {{ strtoupper($ext) }}
                                    </span>
                                </div>

                                <div class="col-span-2 flex justify-end items-center mx-4">
    <form action="{{ route('tutor.material.delete', $material->id) }}" method="POST"
          onsubmit="return confirm('Are you sure you want to delete this file?');">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-red-600 text-white hover:bg-red-700 rounded-lg text-sm font-semibold shadow-sm transition-all">
            Delete
        </button>
    </form>
</div>


                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Upload Button -->
        <div class="flex justify-center pt-4">
    <a href="{{ route('tutor.materials.primary.unified', ['slug' => $subject->slug]) }}"
       class="inline-flex items-center px-6 py-3 bg-[#003a8c] border border-transparent rounded-lg font-bold text-yellow-300 hover:bg-yellow-300 hover:text-[#003a8c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#003a8c] transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
        Upload New Material
    </a>
</div>


    </div>
</x-app-layout>
