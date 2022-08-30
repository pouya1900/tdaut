@extends('layouts.front')

@section('content')

    <div class="row m-0">

        @include('front.partials.profile_side_bar')

        <div class="col-10 p-0">

            <div class="profile_main_wrapper">

                <div class="profile_main">
                    <div class="profile_main--link">
                        <ul>
                            <li>
                                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-github"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-solid fa-file-pdf"></i><span>resume</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="profile_main_content">

                        <div class="row justify-content-around">
                            <div class="col-4">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="profile_main--avatar">
                                            <img src="storage/assets/test/logo.jpg" title="" alt="">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="profile_main--name">
                                            <p>پویا راهواره</p>
                                        </div>
                                        <div class="profile_main--about">
                                            <p class="about_title">درباره</p>
                                            <p class="about_text">کارشناس نرم افزار ، برنامه نویس وب ، فارغ التحصیل
                                                امیرکبیر</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="profile_main--item">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="item_title">سمت</p>
                                            <p class="item_value">دانشجو</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="item_title">دانشکده</p>
                                            <p class="item_value">کامپیوتر</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="item_title">مدرک</p>
                                            <p class="item_value">کارشناسی</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="item_title">شماره دانشجویی</p>
                                            <p class="item_value">9422020</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>




@endsection
