@extends('layouts.main')

@section('content')

    <div class="user_cover">
        <div class="register_form">

            <div class="register_form--title">
                <p>
                    @lang('trs.register')
                </p>
            </div>
            @if (count($errors))
                <div class="alert alert-danger alert-dismissible register_form--alert" role="alert">
                    <strong>{{ $errors->first() }}</strong>
                </div>
            @endif
            <div id="app-user-register">
                <user-register :link="{{json_encode(route('do_register_user'))}}"
                               :old="{{json_encode(old())}}"
                               :data="{{json_encode($data)}}"
                               :csrf="{{json_encode(csrf_token())}}"></user-register>
            </div>

        </div>
    </div>

@endsection
