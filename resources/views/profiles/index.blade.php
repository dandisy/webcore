@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Profiles</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('profiles.create') !!}">Add New</a>
            {{--<button type="button" class="btn btn-info pull-right" style="margin-top: -10px;margin-bottom: 5px;margin-right: 5px" data-toggle="modal" data-target="#myModal">
                Import XLS
            </button>--}}
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('profiles.table')
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{!! url('importProfile') !!}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Data Import</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group col-sm-12">
                        <label for="import">Data:</label>
                        <input id="import" class="form-control" type="file" name="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
@endsection

