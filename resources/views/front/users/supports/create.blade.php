@extends('layouts.front')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('front.partials.user_side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="profile_main_wrapper">
                <div class="profile_main">
                    @include('front.partials.error_message')
                    <form action="{{route('user_support_new_ticket_store')}}" method="post">
                        {{csrf_field()}}
                        <div class="support_new_ticket--title">
                            <div class="mg-office--item">
                                <label for="title">@lang('trs.title')</label>
                                <input type="text" name="title" id="title" placeholder="@lang('trs.title')...">
                            </div>
                        </div>

                        <div class="support_new_ticket--message">
                            <div class="mg-office--item">
                            <textarea name="message" id="message"
                                      placeholder="@lang('trs.type_your_message')..."></textarea>
                            </div>
                        </div>

                        <div class="support_new_ticket--button">
                            <button type="submit">@lang('trs.submit')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
