@php
$navigationItems = [
    ['href' => '#about', 'label' => 'About'],
    ['href' => '#pricing', 'label' => 'Pricing'],
    ['href' => '#testmonials', 'label' => 'Testmonials'],
    ['href' => '/blog', 'label' => 'Blog'],
    ['href' => '#contacts', 'label' => 'Contacts'],
];
@endphp

<div class="hidden md:block">
    <nav aria-label="Global">
        <ul class="flex items-center gap-6 text-sm">
            @foreach ($navigationItems as $item)
                <x-header.navigation-item href="{{ $item['href'] }}">
                    {{ $item['label'] }}
                </x-header.navigation-item>
            @endforeach
        </ul>
    </nav>
</div>
