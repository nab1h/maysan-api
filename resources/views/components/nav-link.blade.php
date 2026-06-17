@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#E60914] text-sm font-bold leading-5 text-[#E60914] focus:outline-none transition duration-300 ease-in-out'
: 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-[#E60914] hover:border-[#E60914] focus:outline-none focus:text-[#E60914] focus:border-[#E60914] transition duration-300 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
