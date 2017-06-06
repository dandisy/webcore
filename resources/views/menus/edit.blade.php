@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Menu
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($menu, ['route' => ['menus.update', $menu->id], 'method' => 'patch']) !!}

                        @include('menus.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection