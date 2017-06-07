<table class="table table-responsive" id="pages-table">
    <thead>
        <th>Title</th>
        <th>Slug</th>
        <th>Content</th>
        <th>Status</th>
        <th>Tag</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($pages as $page)
        <tr>
            <td>{!! $page->title !!}</td>
            <td>{!! $page->slug !!}</td>
            <td>{!! $page->content !!}</td>
            <td>{!! $page->status !!}</td>
            <td>{!! $page->tag !!}</td>
            <td>
                {!! Form::open(['route' => ['pages.destroy', $page->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('pages.show', [$page->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pages.edit', [$page->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>