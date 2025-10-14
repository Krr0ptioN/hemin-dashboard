@php
  $links = [
      ['label' => 'Terms & Conditions', 'href' => '#'],
      ['label' => 'Privacy Policy', 'href' => '#'],
      ['label' => 'Cookies', 'href' => '#'],
  ];
@endphp

<ul class="flex flex-wrap justify-center gap-4 text-xs lg:justify-end">
  @foreach ($links as $link)
    <li>
      <a href="{{ $link['href'] }}" class="text-gray-500 transition hover:opacity-75">
        {{ $link['label'] }}
      </a>
    </li>
  @endforeach
</ul>
