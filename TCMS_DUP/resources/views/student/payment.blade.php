<x-app-layout>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 w-full max-w-md" style="max-height: 90vh; overflow-y: auto;">
            <!-- Header with icon -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-[#003a8c] rounded-full mb-3 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-[#003a8c]">Confirm Payment</h2>
                <p class="text-gray-500 text-sm mt-1">Review your enrollment details</p>
            </div>

            <!-- Payment details -->
            <div class="space-y-4 mb-6">
                <div class="flex justify-between py-2 border-b border-gray-200">
                    <span class="text-gray-600 text-lg">Month:</span>
                    <span class="font-medium text-[#003a8c] text-lg">May</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-200">
                    <span class="text-gray-600 text-lg">Subjects Enrolled:</span>
                    <span class="font-medium text-[#003a8c] text-lg">2</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-200">
                    <span class="text-gray-600 text-lg">Price per Subject:</span>
                    <span class="font-medium text-[#003a8c] text-lg">RM50.00</span>
                </div>
                <div class="flex justify-between pt-2">
                    <span class="text-base font-bold text-gray-700 text-lg">Total to Pay:</span>
                    <span class="text-xl font-bold text-[#003a8c]">RM100.00</span>
                </div>
            </div>

            <!-- Payment button -->
            <form method="POST" action="{{ route('student.payment.process') }}">
                @csrf
                <input type="hidden" name="amount" value="{{ $totalAmount }}">
                <button type="submit" class="w-full group relative flex justify-center py-2 px-4 border border-transparent text-base font-bold rounded-full shadow-md text-yellow-300 bg-[#003a8c] hover:bg-yellow-300 hover:text-[#003a8c] transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:text-[#003a8c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </span>
                    Proceed to Payment
                </button>
            </form>

            <!-- Secure payment notice -->
            <div class="mt-3 flex items-center justify-center text-xs text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
                Secure SSL encrypted payment
            </div>
        </div>
    </div>
</x-app-layout>