<table class="table table-responsive" id="users-table">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Type</th>
        <th>Id Card Type</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Fax</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->name !!}</td>
            <td>{!! $user->email !!}</td>
            <td>{!! $user->type !!}</td>
            <td>{!! $user->id_card_type !!}</td>
            <td>{!! $user->address !!}</td>
            <td>{!! $user->phone !!}</td>
            <td>{!! $user->fax !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>