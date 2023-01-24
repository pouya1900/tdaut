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
                                    action="{{route('user_support_new_message',['support'=>$support->id])}}"
                                    method="post">
                                    {{csrf_field()}}
                                    <div class="support_message-send--message">
                                        <textarea name="message"
                                                  placeholder="@lang('trs.type_your_message')..."></textarea>
                                    </div>
                                    <div class="support_message-send--button">
                                        <button type="submit"><i
                                                class="fa-solid fa-envelope"></i> @lang('trs.send_message')
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
