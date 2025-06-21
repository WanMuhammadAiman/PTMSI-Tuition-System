<x-app-layout>
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-blue-100 py-6 px-6 sm:px-12 md:px-20 text-gray-800 font-serif">
        <div class="max-w-screen-lg mx-auto bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-[#003a8c]/20 mt-20">
            <!-- Receipt Header -->
            <div class="bg-[#003a8c] px-8 py-4 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold">Payment Receipt</h1>
                        <p class="text-blue-100">PTMSI Education Center</p>
                    </div>
                    <div class="bg-yellow-300 text-[#003a8c] p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Receipt Content -->
            <div class="p-8">
                @if($latestPayment)
                    <!-- Student Info -->
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-[#003a8c] border-b-2 border-yellow-300 pb-2 mb-2">Student Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-lg">
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <p class="text-sm text-blue-600 font-medium">Full Name</p>
                                <p class="font-medium">{{ auth()->user()->name }}</p>
                            </div>
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <p class="text-sm text-blue-600 font-medium">Email</p>
                                <p class="font-medium">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-[#003a8c] border-b-2 border-yellow-300 pb-2 mb-2">Payment Details</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#003a8c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span class="font-medium">Transaction ID</span>
                                </div>
                                <span class="font-mono">{{ $latestPayment->transactionID ?? 'N/A' }}</span>
                            </div>

                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#003a8c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-medium">Payment Date</span>
                                </div>
                                <span>{{\Carbon\Carbon::parse($latestPayment->paymentDate)->format('d M Y, h:i A') }}</span>
                            </div>

                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#003a8c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span class="font-medium">Subjects Paid</span>
                                </div>
                                <span>{{ $latestPayment->subject_count ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-6 mb-6">
                        <h3 class="text-lg font-semibold text-[#003a8c] mb-2">Payment Summary</h3>
                        <div class="flex justify-between items-center p-3">
                            <span class="font-bold text-lg">Total Amount:</span>
                            <span class="font-bold text-2xl text-[#003a8c]">RM{{ number_format($latestPayment->amount ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 mt-2">
                            <span class="font-bold text-lg">Status:</span>
                            <span class="px-4 py-1 rounded-full font-bold {{ $latestPayment->paymentStatus ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $latestPayment->paymentStatus ? 'PAID' : 'UNPAID' }}
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-center gap-4 mt-6">
                        <a href="{{ route('student.dashboard') }}" class="flex items-center justify-center px-6 py-3 bg-[#003a8c] text-yellow-300 rounded-full hover:bg-[#002766] transition font-bold shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Back to Dashboard
                        </a>
                        <button onclick="window.print()" class="flex items-center justify-center px-6 py-3 bg-yellow-300 text-[#003a8c] rounded-full hover:bg-yellow-400 transition font-bold shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Print / Save as PDF
                        </button>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-4 text-xl font-semibold text-gray-700">No Payment Record Found</h3>
                        <p class="mt-2 text-gray-500">You don't have any payment records yet.</p>
                        <a href="{{ route('student.dashboard') }}" class="mt-6 inline-flex items-center px-6 py-2 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-[#003a8c] hover:bg-[#002766]">
                            Back to Dashboard
                        </a>
                    </div>
                @endif
            </div>

            
        </div>
    </div>
</x-app-layout>
