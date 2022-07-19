@extends('layouts.front')
@section('content')

    <div id="main_container">
        <div class="video_background background_full">
            <video class="" id="video0" autoplay muted>
                <source src="storage/assets/background/video0.mp4">
            </video>
        </div>
        <div class="image_background background_full ">
            <img class="display-none" id="image0" src="storage/assets/background/image0.png">
        </div>
    </div>



    <div class="infographic_container display-none">
        <div class="top_menu">
            <ul>
                <li><a href="#">درباره ما</a></li>
                <li><a href="#">تماس با ما</a></li>
                <li><a href="#">مدیریت واحد</a></li>
            </ul>
        </div>
        <div class="infographic_logo">
            <img src="storage/assets/siteContent/logo.png">
        </div>
        <div class="infographic_section">
            <ul>
                <li>
                    <a href="#">
                        <div class="section_container">
                            <div class="row full-width">
                                <div class="col-2">
                                    <div class="section_icon"><i class="fa-solid fa-building"></i></div>
                                </div>
                                <div class="col-8">
                                    <div class="section_content"><span>دفتر خدمات فناوری</span></div>
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
                                <div class="section_content"><span>نمایشگاه دائمی</span></div>
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
                                <div class="section_icon"><i class="fa-solid fa-building"></i></div>
                            </div>
                            <div class="col-8">
                                <div class="section_content"><span>مشتریان</span></div>
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
            </ul>
        </div>
    </div>

@endsection
