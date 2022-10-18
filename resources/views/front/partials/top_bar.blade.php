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
            <span>{{$user_instance->profile->fullName}}</span>
        </div>
        <div class="top_bar_logo">
{{--            <img src="" alt="">--}}
        </div>

    @else
        <div class="top_bar_profile">
            <span>ثبت نام / ورود</span>
        </div>

    @endif


</div>
