@props(['title' => null])

<x-layouts.site :title="$title">
    {{ $slot }}
</x-layouts.site>
