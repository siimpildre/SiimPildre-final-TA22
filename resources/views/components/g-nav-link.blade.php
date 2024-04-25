@props(['active'])

@php
$classes = ($active ?? false)
            ? 'rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-orange-500 focus:outline-none focus-visible:ring-orange-500/90 nderline-orange-500/90'
            : 'rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-orange-500 focus:outline-none focus-visible:ring-orange-500/90';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
