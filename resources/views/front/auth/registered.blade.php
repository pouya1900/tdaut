@extends('layouts.main')

@section('content')

    <div class="{{$type=='member' ? 'member_cover' : 'user_cover'}}">

        <div class="login_form">

            <div class="login_form--title">
                <p>
                    @lang('trs.registered_successfully')
                </p>
            </div>

            <div class="">
                <p>
                    @lang('trs.confirm_email_text')
                </p>
                <p>
                    just for development : <a href="{{$link}}">confirm</a>
                </p>
            </div>

        </div>

    </div>

@endsection
