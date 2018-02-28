<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    <div id="image-thumb">
        <img src="dummy-image.jpg" style="width:100%">
    </div>
    <div class="input-group">
        {!! Form::text('image', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        <div class="input-group-btn">
            <a href="{!! url('assets/dialog?filter=all&appendId=image') !!}" class="btn btn-primary filemanager fancybox.iframe" data-fancybox-type="iframe">Choose File</a>
        </div>
    </div>
</div>

<!-- Biografy Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('biografy', 'Biografy:') !!}
    {!! Form::textarea('biografy', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('profiles.index') !!}" class="btn btn-default">Cancel</a>
</div>
