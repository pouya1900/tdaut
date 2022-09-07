@extends('layouts.front')

@section('content')
    <div class="office_page_poster">
        <div class="row g-0">

            <div class="col d-none d-lg-block">
                <div class="poster_content">
                    <div class="poster_title"><h5>
                            دفاتر خدمات فناوری
                        </h5>
                    </div>
                    <div class="poster_description">
                        <p>
                            لورم ایپسوم یک متن ساختگی با تولید ساختگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                            است.
                        </p>
                    </div>
                    <div class="poster_button">

                        <a href="#">
                            <div>مشتریان</div>
                        </a>


                        <a href="#">
                            <div>دفاتر</div>
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
                                دفاتر خدمات فناوری
                            </h5>
                        </div>
                        <div class="poster_description">
                            <p>
                                لورم ایپسوم یک متن ساختگی با تولید ساختگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                گرافیک
                                است.
                            </p>
                        </div>
                        <div class="poster_button">

                            <a href="#">
                                <div>مشتریان</div>
                            </a>


                            <a href="#">
                                <div>دفاتر</div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="offices_container">
        <div class="container">

            <div class="offices_filter_container">

                <div class="offices_filter">
                    <select class="form-select" name="department">
                        <option>دانشکده</option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="offices_search input-group">
                    <span class="input-group-text" id="search"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="search" name="search" aria-label="search"
                           aria-describedby="search">
                </div>

            </div>

            <div class="row">
                @foreach($offices as $office)
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <a href="{{route('office_show',$office->id)}}">
                            <div class="office_container">
                                <div class="office_thumbnail">
                                    <img src="{{$office->logo}}">
                                    <div class="sparkle">
                                        <ul>
                                            @foreach($office->capabilities()->limit(3)->get() as $capability)
                                                <li>{{$capability->text}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="office_content">
                                    <div class="office_title">
                                        <span>{{$office->name}}</span>
                                    </div>

                                    <div class="office_description">
                                        <p>{{$office->about}}
                                        </p>
                                    </div>

                                    <div class="">
                                        <span class="office_key">دانشکده : </span>
                                        <span class="office_value">{{$office->department->title}}</span>
                                    </div>
                                    <div class="">
                                        <span class="office_key">پروژه : </span>
                                        <span class="office_value">{{$office->projects_count}}</span>
                                    </div>
                                    <div class="">
                                        <span class="office_key">رئیس : </span>
                                        <span class="office_value">{{$office->head->profile->fullName}}</span>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection


