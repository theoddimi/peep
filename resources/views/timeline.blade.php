@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @include('partials.peeps.create')
          <br>
            <div class="card">
                <div class="card-header">{{ __('Timeline') }}</div>

                <div class="card-body">
                  @foreach($peeps as $peep)
                  <div class="peep-body-content">
                    @include('partials.peeps.show')
                  </div>
                  <div class="spacer-10"></div>

                  @endforeach
                </div>
            
                <div class="paginator">
                {{ $peeps->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
