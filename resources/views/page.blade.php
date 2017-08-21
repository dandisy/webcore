@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if($pageContent)
            {!! $pageContent !!}
        @else
            <div class="col-sm-12 no-content">
                <div class="page-title">
                    <h3>{{ $slug }}</h3>
                </div>

                <div class="panel">
                    <div class="panel-body">
                        <h2>Tidak ada konten!</h2>
                        <p>Buat dan tulis konten halaman ini.</p>
                    </div>
                </div>
            </div>
        @endif
    </div><!-- /row -->
</div><!-- /container -->
@endsection