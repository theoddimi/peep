<div>
<h1>{{env('APP_NAME', 'PeeP')}}</h1>
<h4>You have a new follower!</h4>
<a href="{{route('user.profile',$user->username)}}"><span>@<span>{{$user->username}}</a>
</div>
