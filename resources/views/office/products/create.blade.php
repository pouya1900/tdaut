@extends('layouts.office_panel')

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <form action="{{route('mg.product_store',$office->id)}}" method="post">
                    {{csrf_field()}}
                    @include('front.partials.error_message')
                    <div class="row m-0">
                        <div class="col-12">
                            <div class="mg-office--item">

                                <label>@lang('trs.title')</label>
                                <input type="text" name="title"
                                       placeholder="@lang('trs.title')">
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="mg-office--item">
                                <label>@lang('trs.description')</label>
                                <textarea type="text" name="description"
                                          placeholder="@lang('trs.description')"></textarea>
                            </div>
                        </div>


                        <div class="col-12 col-lg-6">
                            <div class="mg-office--item">
                                <label>@lang('trs.category')</label>
                                <select name="category">

                                    <option>@lang('trs.category')...</option>

                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">
                                            {{$category->title}}
                                        </option>
                                    @endforeach

                                </select>

                            </div>
                        </div>


                        <div class="col-12 col-lg-6">
                            <div class="mg-office--item">

                                <label>@lang('trs.demo_link')</label>
                                <input type="text" name="link"
                                       placeholder="@lang('trs.demo_link')">
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
        </div>
    </div>
@endsection
