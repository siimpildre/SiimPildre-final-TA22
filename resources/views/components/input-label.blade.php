@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-orange-500']) }}>
    {{ $value ?? $slot }}
</label>
