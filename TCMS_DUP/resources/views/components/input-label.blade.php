<label  {{ $attributes->merge(['class' => 'block font-semibold text-sm text-black !text-black']) }}>
    {{ $value ?? $slot }}
</label>
