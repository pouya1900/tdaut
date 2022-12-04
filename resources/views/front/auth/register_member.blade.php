@extends('layouts.main')

@section('content')
    <div class="member_cover">

        <div class="register_form">

            <div class="register_form--title">
                <p>
                    @lang('trs.register')
                </p>
            </div>
            <form method="post" action="{{route('do_register_member')}}">
                {{ csrf_field()  }}
                @if (count($errors))
                    <div class="alert alert-danger alert-dismissible register_form--alert" role="alert">
                        <strong>{{ $errors->first() }}</strong>
                    </div>
                @endif
                <div id="app-member-register">

                    <member-register :old="{{json_encode(old())}}"
                                     :data="{{json_encode($data)}}"
                                     :username_link="{{json_encode(route('check_username'))}}">
                    </member-register>
                </div>

            </form>

        </div>

    </div>

@endsection

@section('script')


@endsection
