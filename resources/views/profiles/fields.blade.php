<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    <div id="image-thumb">
        <img src="{{ isset($profile->image) ? $profile->image : 'https://dummyimage.com/600x100/f5f5f5/999999&text=Webcore' }}" style="width:100%">
    </div>
    <div class="input-group">
        {!! Form::text('image', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        <div class="input-group-btn">
            <a href="{!! url('assets/dialog?filter=all&appendId=image') !!}" class="btn btn-primary filemanager fancybox.iframe" data-fancybox-type="iframe">Choose File</a>
        </div>
    </div>
</div>

<div class="clearfix"></div>

@role(['superadministrator'])
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', $user->pluck('email', 'id')->toArray(), null, ['class' => 'form-control select2']) !!}
</div>

<div class="clearfix"></div>
@endrole

<!-- Biografy Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('biografy', 'Biografy:') !!}
    {!! Form::textarea('biografy', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! Auth::user()->hasRole(['administrator','user']) ? url('dashboard') : route('profiles.index') !!}" class="btn btn-default">Cancel</a>
    <a href="{!! url('users/'.Auth::user()->id.'/edit') !!}" class="btn btn-danger pull-right">Change Password</a>
</div>
