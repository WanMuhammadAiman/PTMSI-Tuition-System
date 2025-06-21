<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-yellow-100 via-blue-100 to-blue-200 flex items-center justify-center p-6">
        <div class="bg-white p-8 rounded-2xl shadow-xl max-w-md w-full text-center border border-[#003a8c]/20">
            <!-- Success Icon -->
            <div class="flex justify-center mb-4">
                <div class="bg-[#003a8c] text-yellow-300 rounded-full p-4 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Message -->
            <h1 class="text-2xl font-bold text-[#003a8c] font-serif mb-2">Payment Successful!</h1>
            <p class="text-gray-600 mb-6 font-serif">Thank you for your payment. Your enrolment is now confirmed.</p>

            <!-- Buttons -->
            <div class="flex justify-center gap-4">
                <a href="{{ route('student.dashboard') }}" class="px-5 py-2 rounded-full bg-[#003a8c] text-yellow-300 hover:bg-yellow-300 hover:text-[#003a8c] transition font-bold shadow-md">
                    Go to Dashboard
                </a>
                <a href="{{ route('student.receipt', ['id' => $receipt_id]) }}" class="px-5 py-2 rounded-full bg-yellow-300 text-[#003a8c] hover:bg-[#003a8c] hover:text-yellow-300 transition font-bold shadow-md">
    View Receipt
</a>

            </div>
        </div>
    </div>
</x-app-layout>
