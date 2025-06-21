@props(['disabled' => false])

<input
    {{ $attributes->merge([
        'class' => 'bg-white border border-gray-300 text-gray-900 rounded-md shadow-sm focus:ring-yellow-300 focus:border-yellow-400 block w-full'
    ]) }}
/>
