@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Article2
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($article2, ['route' => ['article2s.update', $article2->id], 'method' => 'patch']) !!}

                        @include('article2s.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection