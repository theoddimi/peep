@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if(\Request::route()->getName() === "peep.show")
            {{dd($peep)}}
            @include('partials.peeps.show')
            @endif
        </div>
    </div>
</div>


@endsection
