{{--<div class="col-sm-6">
    <div class="row">--}}
        <!-- Name Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Description Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('description', 'Description:') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        </div>
    {{--</div>
</div>

<div class="col-sm-6">
    <div class="row">
        <!-- Permission Field -->
        <div class="col-sm-12">
            {!! Form::label('permission', 'Permission:') !!}
            <div class="form-group">
            @foreach($permission as $item)
                <label class="form-group col-sm-4">
                    {!! Form::checkbox('permission[]', $item->id) !!} {!! $item->display_name !!}
                </label>
            @endforeach
            </div>
        </div>
    </div>
</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('roles.index') !!}" class="btn btn-default">Cancel</a>
</div>
