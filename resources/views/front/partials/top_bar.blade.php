<div class="top_bar">

    @if ($current_user || $current_member)

        @php
            if ($current_user) {
              $user_instance=$current_user;
            }
              else {
                  $user_instance=$current_member;
             }
        @endphp

        <div class="top_bar_profile">
            <span><i class="fa-solid fa-user"></i></span>
            <span><a
                    href="{{route('profile_show',$user_instance->id)}}">{{$user_instance->profile->fullName}}</a></span>
        </div>
        <div class="top_bar_logo">
            {{--            <img src="" alt="">--}}
        </div>

    @else
        <div class="top_bar_profile">
            <span><a href="{{route('register_member')}}">ثبت نام</a></span>
            <span><a href="{{route('login','member')}}">ورود</a></span>
        </div>

    @endif


</div>
