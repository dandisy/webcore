<div class="col-sm-6">
    <div class="row">
        <!-- Name Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Email Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Password Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('confirm_password', 'Confirm Password:') !!}
            {!! Form::password('confirm_password', ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="row">
        <!-- Role Field -->
        <div class="col-sm-12">
            {!! Form::label('role', 'Role:') !!}
            <div class="form-group">
                @foreach($role as $item)
                    <label class="form-group col-sm-12">
                        {!! Form::radio('role', $item->id) !!} {!! $item->display_name !!}
                    </label>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
