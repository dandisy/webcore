<table class="table table-responsive" id="profiles-table">
    <thead>
        <th>Type</th>
        <th>Id Card Type</th>
        <th>Id Card Number</th>
        <th>Job Position</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Fax</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($profiles as $profile)
        <tr>
            <td>{!! $profile->type !!}</td>
            <td>{!! $profile->id_card_type !!}</td>
            <td>{!! $profile->id_card_number !!}</td>
            <td>{!! $profile->job_position !!}</td>
            <td>{!! $profile->address !!}</td>
            <td>{!! $profile->phone !!}</td>
            <td>{!! $profile->fax !!}</td>
            <td>
                {!! Form::open(['route' => ['profiles.destroy', $profile->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('profiles.show', [$profile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('profiles.edit', [$profile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>