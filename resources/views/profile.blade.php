@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
<div class="peep-card container">
    <div class="card-header peep-card-header row">
      <div class="col-md-4">
      <a href="{{route('user.avatar.edit',$user->username)}}"  class="peep-avatar ">
      <div class="avatar-container ">
        <img class="avatar"src="{{$user->avatar()}}"/>
      </div>
      </a>
      <div class="peep-count-container"><span class="peep-count"><h4 style="display:inline"> <b>{{$user->peeps->count()}}</b></h4> Peeps</span></div>
      </div>
      <div class="peep-user-head col-md-8">
        <div class="row">
        <div class="peep-user-info col-md-9">
          <span class= "peep-user-name">{{$user->name}}</span>
          <span class= "peep-user-username">{{$user->username}}</span><br>
        </div>
          @if(\Auth::id() !== $user->id)
          <div class="peep-action-post  col-md-3">
            @if($user->alreadyFollow())
              <form method="post" action="{{route('user.unfollow')}}">
                @csrf
                <input type="hidden" name="unfollowId" value="{{$user->id}}">
                <button type="submit" class="btn">Unfollow</button>
              </form>
            @else
              <form method="post" action="{{route('user.follow')}}">
                @csrf
                <input type="hidden" name="followId" value="{{$user->id}}">
                <button type="submit" class="btn">Follow</button>
              </form>
            @endif
          </div>
          @endif
        </div>
      </div>
    </div>
    <div class="card-body peep-card-body">
      <div class="peep-body-head">
        <p class="peep-card-body-head-text">
          <div class="profile-followers-container">
          <span id="followers-count">{{$user->followersCount()}}</span>
          <label for="followers-count">{{__('Followers')}}</label>
          <span class="divider"></span>
          <span id="following-count">{{$user->followingCount()}}</span>
          <label for="following-count">{{__('Following')}}</label>
          <span class="peep-mention"></span>
          <span class="peep-tag"></span>
        </div>
        </p>
      </div>

      @foreach($peeps as $peep)
      <div class="peep-body-content">
        @include('partials.peeps.show')
      </div>
      <div class="spacer-10"></div>

      @endforeach

    </div>
    <div class="paginator float-right">
    {{ $peeps->links() }}
    </div>
</div>

</div>
</div>
</div>
@error('peep_image')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
@endsection
