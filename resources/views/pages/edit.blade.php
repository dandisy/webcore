@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Page
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($page, ['route' => ['pages.update', $page->id], 'method' => 'patch']) !!}

                        @include('pages.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection