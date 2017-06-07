<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    <div id="image-thumb"></div>
    {!! Form::text('image', null, ['readonly' => 'readonly']) !!}
    <div class="text-right" style="margin-top: 5px">
        <a href="{!! url('assets/dialog?filter=all&appendId=image') !!}" class="btn btn-primary filemanager fancybox.iframe" data-fancybox-type="iframe">Choose File</a>
    </div>
</div>
<div class="clearfix"></div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['1' => 'individu', '2' => 'organisation', '3' => 'corporation'], null, ['class' => 'form-control']) !!}
</div>

<!-- Id Card Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_card_type', 'Id Card Type:') !!}
    {!! Form::text('id_card_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Card Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_card_number', 'Id Card Number:') !!}
    {!! Form::text('id_card_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Job Position Field -->
<div class="form-group col-sm-6">
    {!! Form::label('job_position', 'Job Position:') !!}
    {!! Form::text('job_position', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('profiles.index') !!}" class="btn btn-default">Cancel</a>
</div>
