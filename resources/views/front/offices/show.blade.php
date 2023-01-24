@extends('layouts.office')
@section('content')


    <div class="slideContainer">
        <div class="office_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- Container wrapper -->
                <div class="container-fluid">
                    <!-- Toggle button -->
                    <button class="navbar-toggler px-0" type="button" data-mdb-toggle="collapse"
                            data-mdb-target="#navbarExampleOnHover" aria-controls="navbarExampleOnHover"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Collapsible wrapper -->
                    <div class="collapse navbar-collapse" id="navbarExampleOnHover">
                        <!-- Left links -->
                        <ul class="navbar-nav me-auto ps-lg-0" style="padding-left: 0.15rem">
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{route('office_members',['office'=>$office->id,'type'=>'head'])}}">ریاست</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{route('office_members',['office'=>$office->id,'type'=>'board'])}}">اعضای
                                    هیئت مدیره</a>
                            </li>
                            <!-- Navbar dropdown -->
                            <li class="nav-item dropdown dropdown-hover position-static">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-mdb-toggle="dropdown" aria-expanded="false">
                                    محصولات
                                </a>
                                <!-- Dropdown menu -->
                                <div class="dropdown-menu mt-0" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;
                            border-top-right-radius: 0;
                          ">

                                    <div class="container">

                                        <div class="list-group list-group-flush">
                                            @foreach($office->categoriesList as $category)
                                                <a href="{{route('office_products',['office'=>$office->id,'category'=>$category->id])}}"
                                                   class="list-group-item list-group-item-action">{{$category->title}}</a>
                                            @endforeach
                                            <a href="{{route('office_products',['office'=>$office->id])}}"
                                               class="list-group-item list-group-item-action">@lang('trs.all')</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a data-bs-toggle="modal" data-bs-target="#capabilityModal" class="nav-link"
                                   href="#">@lang('trs.capabilities')</a>
                            </li>

                            <li class="nav-item">
                                @if ($current_user)
                                    <a class="nav-link" href="{{route('office_rfp',$office->id)}}">
                                        @lang('trs.submit_rfp')
                                    </a>
                                @else
                                    <a data-bs-toggle="modal" data-bs-target="#rfpModal" class="nav-link"
                                       href="#">@lang('trs.submit_rfp')</a>
                                @endif

                            </li>


                            <li class="nav-item dropdown dropdown-hover position-static">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-mdb-toggle="dropdown" aria-expanded="false">
                                    ارتباط با ما
                                </a>
                                <!-- Dropdown menu -->
                                <div class="dropdown-menu mt-0" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;
                            border-top-right-radius: 0;
                          ">

                                    <div class="container">

                                        <div class="list-group list-group-flush">
                                            <a href="{{route('office_contact',$office->id)}}"
                                               class="list-group-item list-group-item-action">اطلاعات تماس</a>
                                            @if ($current_user)

                                                <a href="{{route('office_chat',$office->id)}}"
                                                   class="list-group-item list-group-item-action">@lang('trs.chat')</a>
                                            @else
                                                <a data-bs-toggle="modal" data-bs-target="#chatModal" class="nav-link"
                                                   href="#">@lang('trs.chat')</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </li>


                        </ul>
                        <!-- Left links -->
                    </div>
                    <!-- Collapsible wrapper -->
                </div>
                <!-- Container wrapper -->
            </nav>
        </div>
        <div class="slideshow-container">

            @php($i=1)
            @foreach($office->slideshow as $slide_show)
                <div class="mySlides fade_slide">
                    {{--                    <div class="numbertext">{{$i}} / 3</div>--}}
                    <img src="{{$slide_show}}" style="width:100%">
                    {{--                    <div class="text">Caption Text</div>--}}
                </div>
                @php($i++)
            @endforeach


            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

        </div>

        <br>

    </div>

    <div class="offices_container">
        <div class="office_content">
            {!! $office->content !!}
        </div>
    </div>
    <div class="modal fade" id="capabilityModal" tabindex="-1" aria-labelledby="capabilityModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="capabilityModalLabel">@lang('trs.capabilities')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach($office->capabilities as $capability)
                        <p class="capabilities"><i class="fa-solid fa-circle-check"></i> {{$capability->text}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rfpModal" tabindex="-1" aria-labelledby="rfpModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="capabilityModalLabel">@lang('trs.submit_rfp')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        @lang('trs.submit_rfp_need_login_as_user')
                    </p>

                    <div class="login_register_modal">
                        <p>
                            <a href="{{route('login','user')}}">@lang('trs.login_to_account')</a>
                        </p>
                        <p>
                            <a href="{{route('register_user')}}">@lang('trs.not_registered_yet')</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="capabilityModalLabel">@lang('trs.chat')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        @lang('trs.chat_need_login_as_user')
                    </p>

                    <div class="login_register_modal">
                        <p>
                            <a href="{{route('login','user')}}">@lang('trs.login_to_account')</a>
                        </p>
                        <p>
                            <a href="{{route('register_user')}}">@lang('trs.not_registered_yet')</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript" src="storage/js/slider.js"></script>
@endsection
