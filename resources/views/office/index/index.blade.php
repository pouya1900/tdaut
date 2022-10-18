@extends('layouts.office_panel')

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <form action="{{route('mg.office_update',$office->id)}}" method="post">
                    {{csrf_field()}}
                    @if (count($errors))
                        <div class="alert alert-danger alert-dismissible login_form--alert" role="alert">
                            <strong>{{ $errors->first() }}</strong>
                        </div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible register_form--alert" role="alert">
                            <strong>{{ session('message') }}</strong>
                        </div>
                    @endif
                    <input type="hidden" name="id" value="{{$office->id}}">
                    <div class="row m-0">
                        <div class="col-12 col-lg-6">
                            <div class="mg-office--item">

                                <label>@lang('trs.name')</label>
                                <input type="text" name="name" value="{{$office->name}}"
                                       placeholder="@lang('trs.name')">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mg-office--item">
                                <label>@lang('trs.email')</label>
                                <input type="text" name="email" value="{{$office->email}}"
                                       placeholder="@lang('trs.email')">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mg-office--item">
                                <label>@lang('trs.phone')</label>
                                <input type="text" name="phone" value="{{$office->phone}}"
                                       placeholder="@lang('trs.phone')">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mg-office--item">
                                <label>@lang('trs.address')</label>
                                <input type="text" name="address" value="{{$office->address}}"
                                       placeholder="@lang('trs.address')">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mg-office--item">
                                <label>@lang('trs.admin_contact')</label>
                                <input type="text" name="admin_contact" value="{{$office->admin_contact}}"
                                       placeholder="@lang('trs.admin_contact')">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mg-office--item">
                                <label>@lang('trs.projects_count')</label>
                                <input type="number" name="projects_count" value="{{$office->projects_count}}"
                                       placeholder="@lang('trs.projects_count')">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mg-office--item">
                                <label>@lang('trs.department')</label>
                                <select name="department">

                                    <option>@lang('trs.department')...</option>

                                    @foreach($departments as $department)
                                        <option
                                            value="{{$department->id}}" {{$department->id==$office->department->id ? "selected" : ""}}>
                                            {{$department->title}}
                                        </option>
                                    @endforeach

                                </select>


                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mg-office--item">
                                <label>@lang('trs.about')</label>
                                <textarea type="text" name="about"
                                          placeholder="@lang('trs.about')">{{$office->about}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-4 text-center">
                            <button type="submit" class="edit_profile_button">
                                @lang('trs.submit')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
