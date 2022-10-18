<div class="office_top_bar">
    <div class="row m-0">
        <div class="col-3">
            <div class="uni_logo">
                <img src="storage/assets/test/logo.jpg">

                @if ($current_user || $current_member)

                    @php
                        if ($current_user) {
                          $user_instance=$current_user;
                        }
                          else {
                              $user_instance=$current_member;
                         }
                    @endphp


                    <div class="office_top_bar_profile">
                        <span><i class="fa-solid fa-user"></i></span>
                        <span>{{$user_instance->profile->fullName}}</span>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="office_title">
                <a href="{{route('office_show',$office->id)}}">
                    <h5>{{$office->name}}</h5>
                </a>
            </div>

        </div>
        <div class="col-3">
            <div class="office_logo">
                <a href="{{route('office_show',$office->id)}}">
                    <img src="{{$office->logo}}" title="{{$office->name}}" alt="{{$office->name}}">
                </a>
            </div>
        </div>
    </div>
</div>
