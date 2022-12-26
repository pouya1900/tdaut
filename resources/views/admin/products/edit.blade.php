@extends('layouts.admin')

@section('style')

@endsection

@section('content')
    <style>
        .close-btn[data-v-3904557e] {
            left: 34px !important;
            right: unset !important;
        }

        .custum-icon[data-v-3904557e] {
            margin-left: unset !important;
        }
    </style>
    <form action="{{route('admin.product.update',['product'=>$product->id])}}"
          method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('front.partials.error_message')
        <div class="row m-0">

            @include('office.includes.edit_product_form')

            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.status')</label>
                    <select name="status">

                        <option>@lang('trs.status')...</option>

                        @foreach($statuses as $status)
                            <option
                                value="{{$status}}" {{$status==$product->status? "selected" : ""}}>
                                {{\App\Helper::productStatusToTranslated($status)}}
                            </option>
                        @endforeach

                    </select>


                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="mg-office--item">
                    <label>@lang('trs.status_message')</label>
                    <textarea type="text" name="status_message"
                              placeholder="@lang('trs.status_message')">{{$product->status_message}}</textarea>
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
