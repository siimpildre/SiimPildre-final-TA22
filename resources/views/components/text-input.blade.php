@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-orange-500/75 focus:ring-orange-500/75 rounded-md shadow-sm']) !!}>
