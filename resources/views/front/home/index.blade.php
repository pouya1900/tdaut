@extends('layouts.main')
@section('content')

    <div id="main_container">
        <div class="video_background background_full">
            <video class="" id="video0" autoplay muted>
                <source src="{{$setting->backgroundVideo}}">
            </video>
        </div>
        <div class="image_background background_full ">
            <img class="display-none" id="image0" src="{{$setting->backgroundImage}}">
        </div>
    </div>



    <div class="infographic_container display-none">
        <div class="top_menu">
            <ul>
                <li>
                    <a data-bs-toggle="modal" data-bs-target="#aboutModal"
                       href="#">@lang('trs.about_us')</a>
                </li>
                <li>
                    <a data-bs-toggle="modal" data-bs-target="#aboutModal"
                       href="#">@lang('trs.contact_us')</a>
                </li>
                <li>
                    <a data-bs-toggle="modal" data-bs-target="#aboutModal"
                       href="#">@lang('trs.manager')</a>
                </li>

            </ul>
        </div>
        <div class="infographic_logo">
            <img src="{{$setting->logo}}">
        </div>
        <div class="infographic_section">
            <ul>
                <li>
                    <a href="{{route('offices')}}">
                        <div class="section_container">
                            <div class="row full-width">
                                <div class="col-2">
                                    <div class="section_icon"><i class="fa-solid fa-building"></i></div>
                                </div>
                                <div class="col-8">
                                    <div class="section_content"><span>@lang('trs.technology_service_center')</span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="section_button"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="row full-width">
                            <div class="col-2">
                                <div class="section_icon"><i class="fa-solid fa-industry"></i></div>
                            </div>
                            <div class="col-8">
                                <div class="section_content"><span>@lang('trs.permanent_exhibition')</span></div>
                            </div>
                            <div class="col-2">
                                <div class="section_button"></div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{route('login','user')}}">
                        <div class="row full-width">
                            <div class="col-2">
                                <div class="section_icon"><i class="fa-solid fa-building"></i></div>
                            </div>
                            <div class="col-8">
                                <div class="section_content"><span>@lang('trs.user_panel')</span></div>
                            </div>
                            <div class="col-2">
                                <div class="section_button"></div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{route('login','member')}}">
                        <div class="row full-width">
                            <div class="col-2">
                                <div class="section_icon"><i class="fa-solid fa-building"></i></div>
                            </div>
                            <div class="col-8">
                                <div class="section_content"><span>@lang('trs.member_panel')</span></div>
                            </div>
                            <div class="col-2">
                                <div class="section_button"></div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="row full-width">
                            <div class="col-2">
                                <div class="section_icon"><i class="fa-solid fa-industry"></i></div>
                            </div>
                            <div class="col-8">
                                <div class="section_content"><span>طرح حاتم</span></div>
                            </div>
                            <div class="col-2">
                                <div class="section_button"></div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" id="hampa">
                        <div class="row full-width">
                            <div class="col-2">
                                <div class="section_icon"><i class="fa-solid fa-industry"></i></div>
                            </div>
                            <div class="col-8">
                                <div class="section_content"><span>ورود به همپا</span></div>
                            </div>
                            <div class="col-2">
                                <div class="section_button"></div>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="modal fade" id="hampaRedirectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="hampaRedirectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="redirect_loading--container">
                        <p>
                            @lang('trs.redirecting_to_hampa')
                        </p>
                        <img src="storage/assets/siteContent/loading.gif">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="about_us_modal_item">
                        <p>@lang('trs.about_us') : </p>
                        <p>@lang('trs.about_us_text')</p>
                    </div>
                    <div class="about_us_modal_item">
                        <p>@lang('trs.contact_us') : </p>
                        <p>{{$setting->phone}}</p>
                        <p>{{$setting->email}}</p>
                    </div>
                    <div class="about_us_modal_item">
                        <p>@lang('trs.manager') : </p>
                        <p>@lang('trs.manager_name')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
