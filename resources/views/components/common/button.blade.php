@props(['variant' => 'primary'])

@php
    $variants = [
        'primary',
        'secondary',
        'destructive'
    ];

    if (!in_array($variant, $variants)) {
        throw new InvalidArgumentException("Button: Invalid variant '{$variant}'. Allowed variants: " . implode(', ', $allowedVariants));
    }

    $classes = match ($variant) {
        'primary' => 'bg-teal-600 text-white hover:bg-teal-700 hover:text-white/75',
        'secondary' => 'bg-gray-200 text-gray-800 hover:bg-gray-300 hover:text-gray-600/75',
        'destructive' => 'bg-red-600 text-white hover:bg-red-700 hover:text-white/75',
    };
@endphp

<button {{ $attributes->merge(['class' => "px-4 py-2 rounded-sm transition text-sm font-medium $classes"]) }}>
    {{$slot}}
</button>
