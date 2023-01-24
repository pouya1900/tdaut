@extends('layouts.front')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('front.partials.user_side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="profile_main_wrapper">
                <div class="profile_main">

                    <div class="my-table">
                        @include('front.partials.error_message')
                        <form action="{{route('user_new_rfp_store')}}" method="post">
                            {{csrf_field()}}

                            <div id="app">
                                <search-office :label="{{json_encode(trans('trs.search_desired_office'))}}"
                                               :link="{{json_encode(route('check_office'))}}"></search-office>
                            </div>

                            <div class="rfp_title">
                                <label for="title" class="form-label">@lang('trs.title')</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       placeholder="@lang('trs.title')">
                            </div>
                            <div class="rfp_title">
                                <label for="short_title" class="form-label">@lang('trs.short_title')</label>
                                <input type="text" name="short_title" class="form-control" id="short_title"
                                       placeholder="@lang('trs.short_title')">
                            </div>
                            <div class="rfp_description">
                                <label for="description" class="form-label">@lang('trs.description')</label>
                                <textarea name="description" class="form-control" id="description"
                                          placeholder="@lang('trs.description')"></textarea>
                            </div>
                            <div class="rfp_description">
                                <label for="goals" class="form-label">@lang('trs.goals')</label>
                                <textarea name="goals" class="form-control" id="goals"
                                          placeholder="@lang('trs.goals')"></textarea>
                            </div>
                            <div class="rfp_description">
                                <label for="achievements" class="form-label">@lang('trs.achievements')</label>
                                <textarea name="achievements" class="form-control" id="achievements"
                                          placeholder="@lang('trs.achievements')"></textarea>
                            </div>
                            <div class="rfp_attachment">
                                <label for="file" class="form-label">@lang('trs.sending_file')</label>
                                <input type="file" name="rfp" class="form-control" id="file">
                            </div>

                            <div class="rfp_submit">
                                <button type="submit">ارسال</button>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

@endsection
