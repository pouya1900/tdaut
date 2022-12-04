@extends('layouts.admin')

@section('content')
    <div class="my-table">
        @include('front.partials.error_message')

        <div class="table_title">
            <p>@lang('trs.new_degree')</p>
        </div>

        <form action="{{route('admin.degree.store')}}" method="post">
            {{csrf_field()}}
            <div class="row m-0">
                <div class="col-12 col-lg-6">
                    <div class="mg-office--item">

                        <label>@lang('trs.title')</label>
                        <input type="text" name="title"
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
