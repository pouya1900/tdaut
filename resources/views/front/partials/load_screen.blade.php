<!-- Loading bar -->
<section id="load-screen">
    <!-- right id is ( load-screen ) -->
    <div class="looding-in background-light-grey padding-tb-200px">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-6 text-center">
                    <!-- Loading -->
                    <div class="loading-page">
                        <div class="counter">
                            <div class="text-center loading-page--image"><a href="{{route('index')}}"><img src="{{$setting->logo}}" alt=""></a></div>
                            <div class="loading-page--bar--container">
                                <div class="animation loading-page--bar--body"></div>
                            </div>
                            <div>@lang('trs.loading')<span class="num">0%</span></div>
                        </div>
                    </div>
                    <!-- // Loading -->
                </div>
            </div>
            <!-- // row -->
        </div>
        <!-- // container -->
    </div>
</section>
<!-- // Loading bar -->
