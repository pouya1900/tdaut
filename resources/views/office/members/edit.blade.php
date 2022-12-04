@extends('layouts.office_panel')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <div class="member_edit_name">
                    <h5>{{$member->profile->fullName}}</h5>
                </div>
                <div class="member_edit_form">
                    @include('front.partials.error_message')

                    <div class="member_edit_form--title">
                        <h6>@lang('trs.roles')</h6>
                    </div>
                    <form action="{{route('mg.office_members_update',['office'=>$office->id,'member'=>$member->id])}}"
                          method="post">
                        {{csrf_field()}}
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" name="role[]" type="checkbox" value="{{$role->id}}"
                                       id="role{{$role->id}}" {{$role->id==$role_head->id ? "disabled" : ""}}  {{in_array($role->id,$member->roles($office->id)->pluck('office_roles.id')->toArray()) ? "checked" : ""}}>
                                <label class="form-check-label" for="role{{$role->id}}">
                                    {{$role->title}}
                                </label>
                            </div>
                        @endforeach

                        @if ($member->isSuperAdmin($office->id))
                            <input type="hidden" name="role[]" value="{{$role_head->id}}">
                        @endif

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
