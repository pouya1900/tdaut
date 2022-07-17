@extends('layouts.front')
@section('content')

    <div id="main_container">
        <div class="video_background background_full">
            <video class="" id="video1" autoplay muted>
                <source src="storage/assets/background/video0.mp4">
            </video>
        </div>
    </div>

    <div class="page_container" style="opacity: 0">

        <div class="row full-height">
            <div class="col-4 full-height padding-left-0">
                <div class="side_container">
                    <div class="side_container_logo">
                        <a href="#">
                            <img src="storage/assets/siteContent/logo.png">
                        </a>
                    </div>
                    <div class="side_content">
                        <ul>
                            <li>
                                <a href="#"><i class="fa-solid fa-user-tie"></i>
                                    ورود/ثبت نام مشتریان،کارفرمایان</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-solid fa-user-graduate"></i>
                                    ورود/ثبت نام اساتید،دانشجویان،کارمندان دفاتر</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-8 full-height padding-right-0">
                <div class="infographic_container2">
                    <div class="infographic_section2">
                        <ul class="full-height">
                            <li class="can_container">
                                <a href="#">
                                    <div class="section_container2" data-target="1">
                                        <div id="section1" class="section_background"></div>
                                        <div class="section_title"><span>دفتر خدمات فناوری</span></div>

                                    </div>
                                </a>
                            </li>
                            <li class="can_container">
                                <a href="#">
                                    <div class="section_container2" data-target="2">
                                        <div id="section2" class="section_background"></div>
                                        <div class="section_title"><span>نمایشگاه مجازی</span></div>
                                    </div>
                                </a>
                            </li>
                            <li class="can_container">
                                <a href="#">
                                    <div class="section_container2" data-target="3">
                                        <div id="section3" class="section_background"></div>
                                        <div class="section_title"><span>ارتباط با صنعت</span></div>
                                    </div>
                                </a>
                            </li>
                            <li class="can_container">
                                <a href="#">
                                    <div class="section_container2" data-target="4">
                                        <div id="section4" class="section_background" data-target="4"></div>
                                        <div class="section_title"><span>حمایت از طرح های کلان ملی</span></div>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script async src="https://unpkg.com/es-module-shims@1.3.6/dist/es-module-shims.js"></script>

    <script type="importmap">
  {
    "imports": {
      "three": "https://cdn.jsdelivr.net/npm/three@0.140.0/build/three.module.min.js"
    }
  }

















    </script>
    <script type="module" src="storage/js/threejscode.js"></script>


@endsection
