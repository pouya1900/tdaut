@extends('layouts.office')

@section('style')
    <link rel="stylesheet" href="storage/css/chat.css">
@endsection

@section('content')

    <div class="page_wrapper">

        <div class="contact_container">
            <div class="--dark-theme" id="chat">
                <form action="{{route('office_store_chat',['office'=>$office->id])}}" method="post">
                    {{csrf_field()}}
                    <div class="chat__conversation-board">


                        @foreach($messages as $message)

                            <div
                                class="chat__conversation-board__message-container {{$message->sender=="office" ? "reversed" : ""}} ">
                                <div class="chat__conversation-board__message__person">
                                    <div class="chat__conversation-board__message__person__avatar"><img
                                            src="{{$message->sender=="office" ? $message->office->logo : $message->user->profile->avatar}}"
                                            alt="{{$message->sender=="office" ? $message->office->name : $message->user->profile->fullName}}"/>
                                    </div>
                                    <span
                                        class="chat__conversation-board__message__person__nickname">{{$message->sender=="office" ? $message->office->name : $message->user->profile->fullName}}</span>
                                </div>
                                <div class="chat__conversation-board__message__context">
                                    <div class="chat__conversation-board__message__bubble">
                                        <span>{{$message->text}}</span>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                    <div class="chat__conversation-panel">
                        <div class="chat__conversation-panel__container">
                            {{--                        <button class="chat__conversation-panel__button panel-item btn-icon add-file-button">--}}
                            {{--                            <svg class="feather feather-plus sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg"--}}
                            {{--                                 width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"--}}
                            {{--                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">--}}
                            {{--                                <line x1="12" y1="5" x2="12" y2="19"></line>--}}
                            {{--                                <line x1="5" y1="12" x2="19" y2="12"></line>--}}
                            {{--                            </svg>--}}
                            {{--                        </button>--}}
                            {{--                        <button class="chat__conversation-panel__button panel-item btn-icon emoji-button">--}}
                            {{--                            <svg class="feather feather-smile sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg"--}}
                            {{--                                 width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"--}}
                            {{--                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">--}}
                            {{--                                <circle cx="12" cy="12" r="10"></circle>--}}
                            {{--                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>--}}
                            {{--                                <line x1="9" y1="9" x2="9.01" y2="9"></line>--}}
                            {{--                                <line x1="15" y1="9" x2="15.01" y2="9"></line>--}}
                            {{--                            </svg>--}}
                            {{--                        </button>--}}
                            <input name="message" class="chat__conversation-panel__input panel-item"
                                   placeholder="@lang('trs.type_your_message')"/>
                            <button class="chat__conversation-panel__button panel-item btn-icon send-message-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" aria-hidden="true" data-reactid="1036">
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
