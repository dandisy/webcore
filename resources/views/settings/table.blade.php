<table class="table table-responsive" id="settings-table">
    <thead>
        <th>Title</th>
        <th>Tagline</th>
        <th>Keyword</th>
        <th>Timezone</th>
        <th>Privacy</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($settings as $setting)
        <tr>
            <td>{!! $setting->title !!}</td>
            <td>{!! $setting->tagline !!}</td>
            <td>{!! $setting->keyword !!}</td>
            <td>{!! $setting->timezone !!}</td>
            <td>{!! $setting->privacy !!}</td>
            <td>
                {!! Form::open(['route' => ['settings.destroy', $setting->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('settings.show', [$setting->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('settings.edit', [$setting->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>