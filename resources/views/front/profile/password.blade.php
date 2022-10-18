@extends('layouts.front')

@section('content')

    <div class="row m-0">

        @include('front.partials.profile_side_bar')

        <div class="col-12 col-lg-10 p-0">

            <div class="profile_main_wrapper">
                <div class="profile_main">

                    <form action="{{route('update_profile_password')}}" method="post" autocomplete="off">
                        {{csrf_field()}}

                        @if (count($errors))
                            <div class="alert alert-danger alert-dismissible register_form--alert" role="alert">
                                <strong>{{ $errors->first() }}</strong>
                            </div>
                        @endif
                        @if(session('message'))
                            <div class="alert alert-success alert-dismissible register_form--alert" role="alert">
                                <strong>{{ session('message') }}</strong>
                            </div>
                        @endif

                        <div class="row justify-content-center mb-3">
                            <div class="col-12 col-lg-4">
                                <div class="password_content">
                                    <div class="input-group">
                                        <input class="form-control" type="password" name="old_password"
                                               id="old_password"
                                               placeholder="@lang('trs.old_password')">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-12 col-lg-4">
                                <div class="password_content">
                                    <div class="input-group">
                                        <input class="form-control" type="password" name="password" id="password"
                                               placeholder="@lang('trs.password')">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-3">
                            <div class="col-12 col-lg-4">
                                <div class="password_content">
                                    <div class="input-group">
                                        <input class="form-control" type="password" name="password_confirmation"
                                               id="password_confirmation"
                                               placeholder="@lang('trs.password_confirm')">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-6 col-lg-3">
                                <div class="password_content">
                                    <div class="input-group">
                                        <button class="password_submit" type="submit">
                                            @lang('trs.submit')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>




@endsection
