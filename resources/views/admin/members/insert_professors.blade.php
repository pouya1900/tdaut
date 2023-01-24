@extends('layouts.admin')

@section('style')

@endsection

@section('content')
    <form action="{{route('admin.professors.insert')}}"
          method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('front.partials.error_message')
        <div class="row m-0">
            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.exel')</label>
                    <input type="file" name="file">
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


@endsection

@section('script')

@endsection
