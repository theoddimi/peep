<div class="peep-card container">
  @foreach($list as $user)
    <div class="card-header peep-card-header row">
      <div class="col-md-2">
      <a href='#' target="_blank" class="peep-avatar ">
      <div class="avatar-container ">
        <img class="avatar"src="{{$user->avatar()}}"/>
      </div>
      </a>
      <div class="peep-count-container"><span class="peep-count"><h4 style="display:inline"> <b>{{$user->peeps->count()}}</b></h4> Peeps</span></div>
      </div>
      <div class="peep-user-head col-md-10">
        <div class="row">
        <div class="peep-user-info col-md-9">
          <span class= "peep-user-name">{{$user->name}}</span>
          <span class= "peep-user-username"><a href="{{url('/profile/'.$user->username)}}">{{$user->username}}</a></span>
          <div class="spacer-10"></div>
          <div>
          <span id="followers-count">{{$user->followersCount()}}</span>
          <label for="followers-count">{{__('Followers')}}</label>
          <span class="divider"></span>
          <span id="following-count">{{$user->followingCount()}}</span>
          <label for="following-count">{{__('Following')}}</label>
        </div>
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
      <hr/>

    </div>
    @endforeach
    </div>
