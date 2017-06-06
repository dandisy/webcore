<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $menu->id !!}</p>
</div>

<!-- Label Field -->
<div class="form-group">
    {!! Form::label('label', 'Label:') !!}
    <p>{!! $menu->label !!}</p>
</div>

<!-- Link Field -->
<div class="form-group">
    {!! Form::label('link', 'Link:') !!}
    <p>{!! $menu->link !!}</p>
</div>

<!-- Group Field -->
<div class="form-group">
    {!! Form::label('group', 'Group:') !!}
    <p>{!! $menu->group !!}</p>
</div>

<!-- Parent Field -->
<div class="form-group">
    {!! Form::label('parent', 'Parent:') !!}
    <p>{!! $menu->parent !!}</p>
</div>

<!-- Order Field -->
<div class="form-group">
    {!! Form::label('order', 'Order:') !!}
    <p>{!! $menu->order !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $menu->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $menu->updated_at !!}</p>
</div>

