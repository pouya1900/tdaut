<!-- Sidebar -->



<div class="widget">
    {{--    <h4 class="widget-title filter_drop_down_link">--}}
    {{--        <span class=""> @lang('trs.stops') </span>--}}
    {{--        <span class="filter_drop_down"> ▲ </span>--}}
    {{--    </h4>--}}
    {{--depart--}}
    <div class="widget_content">


            <div class="widget_item">
                <div class="input-group">
                    <span class="input-group-text" id="search"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="search" name="search" aria-label="search"
                           aria-describedby="search">
                </div>
            </div>

    </div>
</div>


<div class="widget">
    {{--    <h4 class="widget-title filter_drop_down_link">--}}
    {{--        <span class=""> @lang('trs.stops') </span>--}}
    {{--        <span class="filter_drop_down"> ▲ </span>--}}
    {{--    </h4>--}}
    {{--depart--}}
    <div class="widget_content">

        <div class="widget-sub-title">
            <span>@lang('trs.categories')</span>

        </div>

        @foreach($categories as $category)
            <div class="widget_item">

                <div class="custom-control custom-checkbox font-weight-600 ">

                    <input type="checkbox" class="custom-control-input" id="category_{{$category->id}}"
                           name="category"
                           value="{{$category->id}}" checked>

                    <label class="custom-control-label" for="category_{{$category->id}}">{{$category->title}}</label>
                </div>

            </div>
        @endforeach

    </div>
</div>

<div class="widget">
    {{--    <h4 class="widget-title filter_drop_down_link">--}}
    {{--        <span class=""> @lang('trs.stops') </span>--}}
    {{--        <span class="filter_drop_down"> ▲ </span>--}}
    {{--    </h4>--}}
    {{--depart--}}
    <div class="widget_content">

        <div class="widget-sub-title">
        </div>

            <div class="widget_item">

                <div class="custom-control custom-checkbox font-weight-600 ">

                    <input type="checkbox" class="custom-control-input" id="3d0"
                           name="3d"
                           value="0" checked>

                    <label class="custom-control-label" for="3d0">@lang('trs.with_3d')</label>
                </div>

            </div>
        <div class="widget_item">

            <div class="custom-control custom-checkbox font-weight-600 ">

                <input type="checkbox" class="custom-control-input" id="3d1"
                       name="3d"
                       value="1" checked>

                <label class="custom-control-label" for="3d1">@lang('trs.without_3d')</label>
            </div>

        </div>
    </div>
</div>


