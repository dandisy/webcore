@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Test
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($test, ['route' => ['tests.update', $test->id], 'method' => 'patch']) !!}

                        @include('tests.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection