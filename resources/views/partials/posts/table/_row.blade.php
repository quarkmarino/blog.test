<tr id="post-{{ $post->id }}">
    <td scope="row">{{ $post->id }}</td>
    <td class="post-author-user_type">{{ $post->author ? __('user.title.types.' . $post->author->user_type) : '' }}</td>
    <td class="post-author">{{ optional($post->author)->full_name }}</td>
    <td class="post-blog_name">{{ $post->blog_name }}</td>
    <td class="post-description">{{ $post->description }}</td>
    <td class="post-published_at">{{ optional($post->published_at)->toDayDateTimeString() }}</td>
    <td>
        {{-- <button class="btn btn-success btn-sm view-post" value="{{ $post->id }}">View</button> --}}
        <button class="btn btn-secondary btn-sm edit-post" value="{{ $post->id }}">Edit</button>
        <button class="btn btn-danger btn-sm delete-post" value="{{ $post->id }}">Delete</button>
    </td>
</tr>
