<table class="table table-responsive" id="menus-table">
    <thead>
        <th>Label</th>
        <th>Link</th>
        <th>Group</th>
        <th>Parent</th>
        <th>Order</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($menus as $menu)
        <tr>
            <td>{!! $menu->label !!}</td>
            <td>{!! $menu->link !!}</td>
            <td>{!! $menu->group !!}</td>
            <td>{!! $menu->parent !!}</td>
            <td>{!! $menu->order !!}</td>
            <td>
                {!! Form::open(['route' => ['menus.destroy', $menu->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('menus.show', [$menu->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('menus.edit', [$menu->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>