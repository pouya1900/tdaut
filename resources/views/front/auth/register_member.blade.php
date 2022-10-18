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


                <div class="member_type_select">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <select name="type" class="form-select">
                                <option selected>انتخاب کنید</option>
                                <option {{old('type')==1 ? 'selected' : ""}} value="1">@lang('trs.professor')</option>
                                <option {{old('type')==2 ? 'selected' : ""}} value="2">@lang('trs.student')</option>
                                <option {{old('type')==3 ? 'selected' : ""}} value="3">@lang('trs.staff')</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div id="professor_register">
                    <div class="row m-0">
                        <div class="col-12 col-lg-6">
                            <div class="register_item">
                                <input type="text" name="email" value="{{old('email')}}"
                                       placeholder="@lang('trs.email')">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="register_item">
                                <input type="text" name="username" value="{{old('username')}}"
                                       placeholder="@lang('trs.username')">
                                <p class="alert_js">
                                    @lang('trs.username_already_use')
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="register_item">
                                <input type="text" name="first_name" value="{{old('first_name')}}"
                                       placeholder="@lang('trs.first_name')">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="register_item">
                                <input type="text" name="last_name" value="{{old('last_name')}}"
                                       placeholder="@lang('trs.last_name')">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="register_item form-check form-check-inline">
                                <label class="form-check-label" for="gender1">@lang('trs.male')</label>
                                <input class="form-check-input" {{old('gender')=='male' ? 'checked' : ''}} type="radio"
                                       name="gender" id="gender1"
                                       value="male">
                            </div>
                            <div class="register_item form-check form-check-inline">
                                <label class="form-check-label" for="gender2">@lang('trs.female')</label>
                                <input class="form-check-input" type="radio"
                                       {{old('gender')=='female' ? 'checked' : ''}} name="gender" id="gender2"
                                       value="female">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="register_item">
                                <select class="form-select" name="rank">
                                    <option selected>@lang('trs.rank')...</option>
                                    @foreach($ranks as $rank)
                                        <option
                                            {{old('rank')==$rank->id ? 'selected' : ''}} value="{{$rank->id}}">{{$rank->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="register_item">
                                <select class="form-select" name="department">
                                    <option selected>@lang('trs.department')...</option>
                                    @foreach($departments as $department)
                                        <option
                                            {{old('department')==$department->id ? 'selected' : ''}} value="{{$department->id}}">{{$department->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="register_item">
                                <input type="text" name="group" value="{{old('group')}}" placeholder="@lang('trs.group')">
                            </div>

                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="register_item">
                                <input type="password" name="password" placeholder="@lang('trs.password')">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="register_item">
                                <input type="password" name="password_confirmation"
                                       placeholder="@lang('trs.password_confirm')">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-6">
                            <div class="register_item">
                                <input type="submit" class="submit" value="@lang('trs.register')">
                            </div>

                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

@endsection
