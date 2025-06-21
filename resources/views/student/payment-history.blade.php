<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-[#003a8c] font-serif tracking-wide">
                {{ __('Payment History') }}
            </h2>
            <div class="bg-yellow-300 text-[#003a8c] px-4 py-1 rounded-full text-sm font-medium">
                Total Payments: RM {{ number_format($payments->sum('amount'), 2) }}
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto"> <!-- Added max-w-5xl and mx-auto to constrain width -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg shadow-xl overflow-hidden border border-[#003a8c]/20 mt-20">
            @if ($payments->isEmpty())
                <div class="p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-700">No payment records found</h3>
                    <p class="mt-1 text-gray-500">All your payment history will appear here once available</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-[#003a8c]">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-yellow-300 uppercase tracking-wider"> <!-- Reduced px-6 to px-4 -->
                                    Date & Time
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-yellow-300 uppercase tracking-wider"> <!-- Reduced px-6 to px-4 -->
                                    Amount
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-yellow-300 uppercase tracking-wider"> <!-- Reduced px-6 to px-4 -->
                                    Receipt
                                </th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-yellow-300 uppercase tracking-wider"> <!-- Reduced px-6 to px-4 -->
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($payments as $payment)
                                <tr class="hover:bg-blue-50 transition-colors duration-150">
                                    <td class="px-4 py-4 whitespace-nowrap"> <!-- Reduced px-6 to px-4 -->
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#003a8c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::parse($payment->paymentDate)->format('d M Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($payment->paymentDate)->format('h:i A') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap"> <!-- Reduced px-6 to px-4 -->
                                        <div class="text-lg font-semibold text-[#003a8c]">
                                            RM {{ number_format($payment->amount, 2) }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap"> <!-- Reduced px-6 to px-4 -->
                                        <a href="{{ route('student.receipt', ['id' => $payment->id]) }}" 
                                           class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-[#003a8c] hover:bg-yellow-300 hover:text-[#003a8c] transition-colors group"> <!-- Added hover effects -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 group-hover:text-[#003a8c]" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <!-- Added group-hover effect -->
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            View
                                        </a>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap"> <!-- Reduced px-6 to px-4 -->
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Completed
                                        </span>
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