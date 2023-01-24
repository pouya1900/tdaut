<div class="messages_users_list--container">
    @foreach($users as $user)
        <a href="{{route('mg.messages',['office'=>$office->id,'user'=>$user])}}">
            <div class="message_users_list--item {{$user->id==$default_user->id ? "message_users_list--active-item" : ""}}">
                <div class="row">
                    <div class="col-4">
                        <div class="message_users_list--avatar">
                            <img src="{{$user->profile->avatar}}" alt="{{$user->profile->fullName}}">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="message_users_list--name">
                            <span>{{$user->profile->fullName}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>
