<table class="table table-responsive" id="posts-table">
    <thead>
        <th>Title</th>
        <th>Slug</th>
        <th>Content</th>
        <th>Tag</th>
        <th>Status</th>
        <th>Category</th>
        <th>Cover</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td>{!! $post->title !!}</td>
            <td>{!! $post->slug !!}</td>
            <td>{!! $post->content !!}</td>
            <td>{!! $post->tag !!}</td>
            <td>{!! $post->status !!}</td>
            <td>{!! $post->category !!}</td>
            <td>{!! $post->Cover !!}</td>
            <td>
                {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('posts.show', [$post->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('posts.edit', [$post->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>