<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    <div id="image-thumb"></div>
    {!! Form::text('image', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
    <div class="text-right" style="margin-top: 5px">
        <a href="{!! url('assets/dialog?filter=all&appendId=image') !!}" class="btn btn-primary filemanager fancybox.iframe" data-fancybox-type="iframe">Choose File</a>
    </div>
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['1' => 'individu', '2' => 'organisation', '3' => 'corporation'], null, ['class' => 'form-control']) !!}
</div>
<div class="clearfix"></div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- New Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::text('password', null, ['class' => 'form-control']) !!}
</div>

<!-- Confirm Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('confirm_password', 'Confirm Password:') !!}
    {!! Form::text('confirm_password', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Card Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_card_type', 'Id Card Type:') !!}
    {!! Form::text('id_card_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Fax Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fax', 'Fax:') !!}
    {!! Form::text('fax', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
