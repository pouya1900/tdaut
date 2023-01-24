@extends('layouts.main')

@section('content')

    <div class="{{$type=='member' ? 'member_cover' : 'user_cover'}}">

        <div class="login_form">

            <div class="login_form--title">
                <p>
                    @lang('trs.confirmation_successfully')
                </p>
            </div>

            <div class="">
                <p>
                    <a href="{{route('login',$type)}}">
                        @lang('trs.login_to_account')
                    </a>
                </p>
            </div>

        </div>

    </div>

@endsection
