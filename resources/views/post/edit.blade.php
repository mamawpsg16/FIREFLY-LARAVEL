<x-layout>
    <x-form.form method="POST" action="{{ route('post.update',$post['id']) }}">
        @method('PUT')
        <label for="Tags">Tags</label>
        <select name="tags[]" multiple required>
            @foreach($tags as $key => $tag)
                <option value="{{ $tag->id }}" {{ in_array($tag['id'],$post_tags) ? 'selected' : '' }}>{{ $tag->name }}</option>
            @endforeach
        </select>
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ $post['title'] }}" required>
        <label for="description">Description</label>
        <textarea name="description" id="" cols="5" rows="5" required>{{ $post['description'] }}</textarea>
        <label for="title">published</label>
        <input type="checkbox" name="is_published" @if($post['is_published']) checked @endif >
        <button type="submit">Save </button>
    </x-form.form>
</x-layout>