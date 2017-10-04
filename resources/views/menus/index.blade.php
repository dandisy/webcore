@extends('layouts.app')

@section('content')
<div class="col-sm-12 col-md-12 col-lg-12">
    {!! Menu::render() !!}
</div>
@endsection

@section('scripts')
{!! Menu::scripts() !!}
@endsection