<div class="messages_users_list--container">
    @foreach($offices as $office)
        <a href="{{route('user_messages',['office'=>$office->id])}}">
            <div
                class="message_users_list--item {{$office->id==$default_office->id ? "message_users_list--active-item" : ""}}">
                <div class="row">
                    <div class="col-4">
                        <div class="message_users_list--avatar">
                            <img src="{{$office->logo}}" alt="{{$office->name}}">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="message_users_list--name">
                            <span>{{$office->name}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>
