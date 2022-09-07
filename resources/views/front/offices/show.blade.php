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
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">توانمندی ها</a>
                            </li>

                            <li class="nav-item dropdown dropdown-hover position-static">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-mdb-toggle="dropdown" aria-expanded="false">
                                    ثبت rfp
                                </a>
                                <!-- Dropdown menu -->
                                <div class="dropdown-menu  mt-0" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;
                            border-top-right-radius: 0;
                          ">

                                    <div class="container">

                                        <div class="list-group list-group-flush">
                                            <a href=""
                                               class="list-group-item list-group-item-action">صنعت</a>
                                            <a href=""
                                               class="list-group-item list-group-item-action">حقیقی</a>
                                            <a href=""
                                               class="list-group-item list-group-item-action">حقوقی</a>
                                        </div>
                                    </div>
                                </div>
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
                                            <a href=""
                                               class="list-group-item list-group-item-action">تلفن</a>
                                            <a href=""
                                               class="list-group-item list-group-item-action">ایمیل</a>
                                            <a href=""
                                               class="list-group-item list-group-item-action">چت</a>
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
                <div class="mySlides fade">
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


@endsection

@section('script')
    <script type="text/javascript" src="storage/js/slider.js"></script>
@endsection
