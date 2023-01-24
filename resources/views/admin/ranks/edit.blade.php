@extends('layouts.admin')

@section('content')
    <div class="my-table">
        @include('front.partials.error_message')

        <form action="{{route('admin.rank.update',$rank->id)}}" method="post">
            {{csrf_field()}}
            <div class="row m-0">
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">

                        <label>@lang('trs.title')</label>
                        <input type="text" name="title" value="{{$rank->title}}"
                               placeholder="@lang('trs.title')">
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
