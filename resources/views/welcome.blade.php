<x-layout>
    @guest
      
    @else
        <a href="{{ route('post.index') }}">Post</a>
        <a href="{{ route('tag.index') }}">Tag</a>
        <a href="{{ route('question.index') }}">Question</a>
    @endguest
</x-layout>