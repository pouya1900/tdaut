@extends('layouts.admin')

@section('style')

@endsection

@section('content')


    <div class="my-table">
        @include('front.partials.error_message')

        <div class="support_title">
            <p>{{$support->title}}</p>
        </div>

        <div class="support_messages--container">
            <div class="support_message--body">
                @foreach($support->messages as $message)
                    @if ($message->sender=="user")
                        <div class="support_message--sender">
                            <p>{{$office ? $office->name : $user->profile->fullName}}</p>
                        </div>
                    @endif

                    <div class="support_message--item {{$message->sender=="user" ? "reverse" : ""}}">
                        <p>{{$message->text}}</p>
                        <div class="support_message--date">
                            <p>{{$message->created_at}}</p>
                        </div>
                    </div>
                @endforeach

                <div class="support_message-send--container">
                    <form
                        action="{{route('admin.support.new_message',['support'=>$support->id])}}"
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


@endsection

@section('script')

@endsection
