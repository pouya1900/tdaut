@extends('layouts.main')

@section('content')

    <div class="{{$type=='member' ? 'member_cover' : 'user_cover'}}">

        <div class="login_form">

            <div class="login_form--title">
                <p>
                    @lang('trs.login_to_account')
                </p>
            </div>

            <form method="post" action="{{$type=='member' ? route('do_login_member') : route('do_login_user')}}">
                {{ csrf_field()  }}
                @if (count($errors))
                    <div class="alert alert-danger alert-dismissible login_form--alert" role="alert">
                        <strong>{{ $errors->first() }}</strong>
                    </div>
                @endif
                <input class="login_form--info" type="email" name="email" placeholder="@lang('trs.email')">

                <input class="login_form--info" type="password" name="password" placeholder="@lang('trs.password')">

                <label title="@lang('trs.remember_me_title')"
                       for="remember-me">@lang('trs.remember_me')</label>
                <input id="remember-me" class="remember-me" name="remember" type="checkbox">
                <input type="submit" class="submit" value="@lang('trs.enter')">
                <div class="forgot_pass">
                    <a href="#">
                        @lang('trs.forgot_password_text')
                    </a>
                </div>

                <div class="forgot_pass">
                    <a href="{{$type=='member' ? route('register_member') : route('register_user')}}">
                        @lang('trs.not_registered_yet')
                    </a>
                </div>

            </form>
        </div>

    </div>

@endsection
