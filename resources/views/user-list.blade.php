@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Users List') }}</div>
        <div class="card-body">
        @include('partials.user.info')
            <div class="spacer-10"></div>
        <div class="paginator">
        {{ $list->links() }}
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
