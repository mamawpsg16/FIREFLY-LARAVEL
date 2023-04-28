@props(['method'=> 'POST', 'action' => ''])
<form method="{{ $method }}" action="{{ $action }}">
    @csrf
    {{ $slot }}
</form>