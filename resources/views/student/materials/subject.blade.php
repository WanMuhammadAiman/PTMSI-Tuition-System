<x-app-layout>
    <x-slot name="header">
        <div class="pb-4 border-b border-[#003a8c]/20">
            <h2 class="text-3xl font-bold text-[#003a8c] font-serif">
                {{ $subject->name }} Learning Materials
            </h2>
            <p class="mt-2 text-gray-600">Manage and access all teaching resources for this subject</p>
        </div>
    </x-slot>

    <div class="p-6 md:p-8 space-y-8">
        @if ($materials->isEmpty())
            <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-[#003a8c]/10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-700">No materials uploaded yet</h3>
                <p class="mt-1 text-gray-500">Get started by uploading your first resource</p>
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
    <div class="col-span-2 font-semibold text-right">Action</div>
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


                                <!-- Download Action -->

                                <div class="col-span-2 text-right">
    <a href="{{ $fileUrl }}" download
       class="inline-flex items-center px-4 py-2 bg-[#003a8c] text-yellow-300 hover:bg-yellow-300 hover:text-[#003a8c] rounded-lg font-semibold text-sm transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
        </svg>
        Download
    </a>
</div>


                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</x-app-layout>
