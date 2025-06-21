<x-app-layout>
    <x-slot name="header">
        <div class="bg-[#003a8c] py-4 px-6 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-yellow-300 font-serif tracking-wide">Career Aptitude Survey</h2>
            <p class="text-yellow-200 mt-1">Discover your career path by answering these questions</p>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-24">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-[#003a8c]/20">
            <form action="{{ route('student.survey.submit') }}" method="POST" class="space-y-6 p-8">
                @csrf
                
                <div class="bg-[#003a8c]/10 p-4 rounded-lg mb-6">
                    <h3 class="text-lg font-semibold text-[#003a8c]">Instructions:</h3>
                    <p class="text-gray-700 mt-1">Please answer each question honestly by selecting either Yes or No.</p>
                </div>

                @foreach($questions as $question)
                    <div class="border-l-4 border-[#003a8c] p-4 rounded-r-lg bg-gray-50 hover:bg-[#003a8c]/5 transition-colors duration-200">
                        <div class="flex items-start">
                            <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-[#003a8c] text-yellow-300 font-bold mr-3 flex-shrink-0">
                                {{ $loop->iteration }}
                            </span>
                            <div class="w-full">
                                <label class="font-semibold text-gray-800 text-lg">{{ $question->question_text }}</label>
                                <div class="mt-3 space-x-6">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="yes" required 
                                               class="h-5 w-5 text-[#003a8c] focus:ring-[#003a8c] border-gray-300">
                                        <span class="ml-2 text-gray-700">Yes</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="no" 
                                               class="h-5 w-5 text-[#003a8c] focus:ring-[#003a8c] border-gray-300">
                                        <span class="ml-2 text-gray-700">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="pt-6 text-center">
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-[#003a8c] border border-transparent rounded-lg font-semibold text-yellow-300 hover:bg-[#002766] hover:text-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#003a8c] transition-all duration-300 shadow-lg transform hover:scale-105">
                        Submit Survey
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>