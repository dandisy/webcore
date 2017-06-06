<table class="table table-responsive" id="article2s-table">
    <thead>
        <th>Description</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($article2s as $article2)
        <tr>
            <td>{!! $article2->description !!}</td>
            <td>
                {!! Form::open(['route' => ['article2s.destroy', $article2->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('article2s.show', [$article2->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('article2s.edit', [$article2->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>