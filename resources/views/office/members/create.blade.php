@extends('layouts.office_panel')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">

                <div class="member_edit_form">
                    <form action="{{route('mg.office_member_store',$office->id)}}"
                          method="post">
                        {{csrf_field()}}
                        @include('office.includes.error_message')


                        <div class="member_edit_form--new">
                                <label>@lang('trs.email')</label>
                                <input type="text" name="email" placeholder="@lang('trs.email')">
                                <input type="hidden" name="member_id" value="2">
                        </div>
                        <div class="member_edit_form--title">
                            <h6>@lang('trs.roles')</h6>
                        </div>

                        @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" name="role[]" type="checkbox" value="{{$role->id}}"
                                       id="role{{$role->id}}" {{$role->id==$role_head->id ? "disabled" : ""}} >
                                <label class="form-check-label" for="role{{$role->id}}">
                                    {{$role->title}}
                                </label>
                            </div>
                        @endforeach

                        <div class="member_edit_form--submit">
                            <button type="submit" class="edit_profile_button">
                                @lang('trs.submit')
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
