@props(['method'=> 'POST', 'action' => ''])
<form method="{{ $method }}" action="{{ $action }}"  {{ $attributes->merge() }}>
    @csrf
    {{ $slot }}
</form>