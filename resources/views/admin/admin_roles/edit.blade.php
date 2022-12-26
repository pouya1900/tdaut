@extends('layouts.admin')

@section('content')
    <div class="my-table">
        @include('front.partials.error_message')

        <div class="member_edit_name">
            <h5>{{$role->title}}</h5>
        </div>
        <div class="member_edit_form">
            @include('front.partials.error_message')
            <div class="member_edit_form--title">
                <h6>@lang('trs.permissions')</h6>
            </div>
            <form action="{{route('admin.role.update',['role'=>$role->id])}}"
                  method="post">
                {{csrf_field()}}
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <input class="form-check-input" name="permission[]" type="checkbox"
                               value="{{$permission->id}}"
                               id="permission{{$permission->id}}" {{in_array($permission->id,$role->permissions()->pluck('admin_permissions.id')->toArray()) ? "checked" : ""}}>
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
@endsection
