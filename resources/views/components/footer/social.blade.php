@props(['class' => ''])

@php
  $socials = [
      ['name' => 'Facebook', 'icon' => 'fab fa-facebook-f', 'href' => '#'],
      ['name' => 'Instagram', 'icon' => 'fab fa-instagram', 'href' => '#'],
      ['name' => 'Twitter', 'icon' => 'fab fa-twitter', 'href' => '#'],
      ['name' => 'GitHub', 'icon' => 'fab fa-github', 'href' => '#'],
      ['name' => 'Dribbble', 'icon' => 'fab fa-dribbble', 'href' => '#'],
  ];
@endphp

<ul class="flex justify-center gap-6 lg:justify-end {{ $class }}">
  @foreach ($socials as $social)
    <x-footer.social-link :name="$social['name']" :icon="$social['icon']" :href="$social['href']" />
  @endforeach
</ul>
