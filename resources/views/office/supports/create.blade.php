@extends('layouts.office_panel')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                @include('front.partials.error_message')
                <form action="{{route('mg.support_new_ticket_store',$office->id)}}" method="post">
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
@endsection

@section('script')

@endsection
