<x-layout>
    {{-- {{ dd($results) }} --}}
    @if(count($results) > 0)
    <ul>
        @foreach($results as $result)
            <a href="{{ route('profile.show',$result['first_name']) }}">
                <li >{{ $result['email'] }}  {{ $result['first_name'] }},{{ $result['middle_name'] }},{{ $result['last_name'] }}</li>
            </a>
        @endforeach
    </ul>
    @else
        <p>No results found.</p>
    @endif
</x-layout>