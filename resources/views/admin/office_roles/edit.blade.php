@extends('layouts.admin')

@section('content')
    <div class="my-table">
        @include('front.partials.error_message')

        <form action="{{route('admin.office-role.update',$role->id)}}" method="post">
            {{csrf_field()}}
            <div class="row m-0">
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">

                        <label>@lang('trs.title')</label>
                        <input type="text" name="title" value="{{$role->title}}"
                               placeholder="@lang('trs.title')">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">
                        <label>@lang('trs.name_english')</label>
                        <textarea type="text" name="name"
                                  placeholder="@lang('trs.name_english')">{{$role->name}}</textarea>
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
@endsection
