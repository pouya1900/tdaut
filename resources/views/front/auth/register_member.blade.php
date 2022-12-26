@extends('layouts.main')

@section('content')
    <div class="member_cover">

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
            {{csrf_field()}}

            <div id="app-member-register">
                <member-register :old="{{json_encode(old())}}"
                                 :data="{{json_encode($data)}}"
                                 :username_link="{{json_encode($link)}}"
                                 :link="{{json_encode(route('do_register_member'))}}"
                                 :csrf="{{json_encode(csrf_token())}}">
                </member-register>
            </div>


        </div>

    </div>

@endsection

@section('script')


@endsection
