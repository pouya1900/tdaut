@extends('layouts.front')

@section('content')
    <div class="office_page_poster">
        <div class="row g-0">

            <div class="col d-none d-lg-block">
                <div class="poster_content">
                    <div class="poster_title"><h5>
                            @lang('trs.technology_service_center')
                        </h5>
                    </div>
                    <div class="poster_description">
                        <p>
                            @lang('trs.technology_service_center_description_text')
                        </p>
                    </div>
                    <div class="poster_button">

                        <a href="{{route('login','user')}}">
                            <div>@lang('trs.user_panel')</div>
                        </a>


                        <a href="{{route('login','member')}}">
                            <div>@lang('trs.member_panel')</div>
                        </a>

                    </div>
                </div>
            </div>
            <div class="col d-none d-lg-block">
                <img class="office_page_poster_image" src="storage/assets/siteContent/office_poster.jpg">
            </div>

            <div class="d-lg-none background-dark">
                <div class="sm_poster_container">

                    <div class="poster_content sm_poster_content">
                        <div class="poster_title"><h5>
                                @lang('trs.technology_service_center')
                            </h5>
                        </div>
                        <div class="poster_description">
                            <p>
                                @lang('trs.technology_service_center_description_text')
                            </p>
                        </div>
                        <div class="poster_button">

                            <a href="{{route('login','user')}}">
                                <div>@lang('trs.user_panel')</div>
                            </a>


                            <a href="{{route('login','member')}}">
                                <div>@lang('trs.member_panel')</div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="app">
        <office-index :departments="{{json_encode($departments)}}"
                      :offices="{{json_encode($offices)}}"
                      :trs="{{json_encode(trans('trs'))}}">
        </office-index>
    </div>

@endsection


