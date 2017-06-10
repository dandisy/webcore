@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Component
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($component, ['route' => ['components.update', $component->id], 'method' => 'patch']) !!}

                        @include('components.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection