<div class="peep-card container">
    <div class="card-header peep-card-header row">
      <div class="col-md-1">
      <a href='#' target="_blank" class="peep-avatar ">
      <div class="avatar-container ">
        <img class="avatar"src="https://api.adorable.io/avatars/50/abott@adorable.png"/>
      </div>
      </a>
      </div>
      <div class="peep-user-head col-md-11">
        <div class="peep-user-info">
          <span class= "peep-user-title">{{$peep->user->name}}</span>
          <span class= "peep-user-peepname">{{$peep->user->email}}</span>
        </div>
      </div>

    </div>

    <div class="card-body peep-card-body">
      <div class="peep-body">
        <p class="peep-card-body-text">
          <span class="">{{$peep->text}}</span>
          <span class="peep-mention"></span>
          <span class="peep-tag"></span>
        </p>

        @if($peep->image()->exists())
        <div class="peep-card-body-media">
          <img  src="{{$peep->image->data}}">
        </div>
        @endif
        <a href="{{route('peep.edit',$peep->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <hr/>
      <div class="peep-date-info">
        {!!$peep->created_at!!}
      </div>

      </div>

    </div>

</div>
