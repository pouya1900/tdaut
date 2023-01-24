@extends('layouts.office_panel')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <div class="member_edit_name">
                    <h5>{{$role->title}}</h5>
                </div>
                <div class="member_edit_form">
                    @include('front.partials.error_message')
                    <div class="member_edit_form--title">
                        <h6>@lang('trs.permissions')</h6>
                    </div>
                    <form action="{{route('mg.office_roles_update',['office'=>$office->id,'role'=>$role->id])}}"
                          method="post">
                        {{csrf_field()}}
                        @foreach($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" name="permission[]" type="checkbox"
                                       value="{{$permission->id}}"
                                       id="permission{{$permission->id}}" {{in_array($permission->id,$role->permissions($office->id)->pluck('office_permissions.id')->toArray()) ? "checked" : ""}}>
                                <label class="form-check-label" for="permission{{$permission->id}}">
                                    {{$permission->title}}
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

