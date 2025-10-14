@props(['name', 'icon', 'href' => '#'])

<li>
  <a href="{{ $href }}" rel="noreferrer" target="_blank"
     class="text-gray-700 transition hover:opacity-75">
    <span class="sr-only">{{ $name }}</span>
    <i class="{{ $icon }} text-xl"></i>
  </a>
</li>
