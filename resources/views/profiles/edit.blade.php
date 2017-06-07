@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Profile
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($profile, ['route' => ['profiles.update', $profile->id], 'method' => 'patch']) !!}

                        @include('profiles.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection