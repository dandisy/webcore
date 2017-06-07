<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', 'Icon:') !!}
    <a href="{!! url('assets/dialog?filter=all&appendId=icon') !!}" class="btn btn-primary filemanager fancybox.iframe" data-fancybox-type="iframe">Choose File</a>
    {!! Form::text('icon', null, ['readonly' => 'readonly']) !!}
    <div id="icon-thumb"></div>
</div>
<div class="clearfix"></div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Tagline Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tagline', 'Tagline:') !!}
    {!! Form::text('tagline', null, ['class' => 'form-control']) !!}
</div>

<!-- Keyword Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keyword', 'Keyword:') !!}
    {!! Form::text('keyword', null, ['class' => 'form-control']) !!}
</div>

<!-- Timezone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('timezone', 'Timezone:') !!}
    {!! Form::select('timezone', ['1' => 'Jakarta'], null, ['class' => 'form-control']) !!}
</div>

<!-- Privacy Field -->
<div class="form-group col-sm-12">
    {!! Form::label('privacy', 'Privacy:') !!}
    <label class="radio-inline">
        {!! Form::radio('privacy', "1", null) !!} public
    </label>

    <label class="radio-inline">
        {!! Form::radio('privacy', "2", null) !!} hidden
    </label>

    <label class="radio-inline">
        {!! Form::radio('privacy', "3", null) !!} private
    </label>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('settings.index') !!}" class="btn btn-default">Cancel</a>
</div>
