@extends('layouts.office_panel')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                @include('front.partials.error_message')

                <div class="support_title">
                    <p>{{$support->title}}</p>
                </div>

                <div class="support_messages--container">
                    <div class="support_message--body">
                        @foreach($support->messages as $message)
                            <div class="support_message--item {{$message->sender=="admin" ? "reverse" : ""}}">
                                <p>{{$message->text}}</p>
                            </div>
                        @endforeach

                        <div class="support_message-send--container">
                            <form
                                action="{{route('mg.support_new_message',['office'=>$office->id,'support'=>$support->id])}}"
                                method="post">
                                {{csrf_field()}}
                                <div class="support_message-send--message">
                                    <textarea name="message" placeholder="@lang('trs.type_your_message')..."></textarea>
                                </div>
                                <div class="support_message-send--button">
                                    <button type="submit"><i class="fa-solid fa-envelope"></i> @lang('trs.send_message')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
