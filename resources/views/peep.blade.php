@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
          @if(\Request::route()->getName() === "peep.show")
            @include('partials.peeps.show')
          @elseif( \Request::route()->getName() === "peep.create")
            @include('partials.peeps.create')
          @elseif( \Request::route()->getName() === "peep.edit")
            @include('partials.peeps.edit')
          @endif
        </div>
    </div>
</div>


@endsection
