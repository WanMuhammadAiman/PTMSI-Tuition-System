<button
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center px-6 py-2 bg-yellow-400 hover:bg-yellow-300 text-black font-bold rounded-xl shadow-md transition'
    ]) }}
>
    {{ $slot }}
</button>
