@extends('layouts.admin')

@section('style')

@endsection

@section('content')


    <div class="my-table">
        @include('front.partials.error_message')
        <div class="member_edit_name">
            <h5>{{$member->profile->fullName}}</h5>
        </div>
        <div class="member_edit_form">
            <div class="member_edit_form--title">
                <h6>@lang('trs.roles_in_office') {{$office->name}}</h6>
            </div>
            <form action="{{route('admin.member.roles.update',['member'=>$member->id,'office'=>$office->id])}}"
                  method="post">
                {{csrf_field()}}
                <input type="hidden" name="from" value="{{$from}}">
                @foreach($roles as $role)
                    <div class="form-check">
                        <input class="form-check-input" name="role[]" type="checkbox" value="{{$role->id}}"
                               id="role{{$role->id}}" {{in_array($role->id,$member_roles) ? "checked" : ""}}>
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


@endsection

@section('script')

@endsection
