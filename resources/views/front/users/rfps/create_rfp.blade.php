@extends('layouts.front')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('front.partials.user_side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="profile_main_wrapper">
                <div class="profile_main">

                    <div class="my-table">
                        @include('front.partials.error_message')

                        <div class="rfp_content">
                            <div class="rfp_header">
                                <h4>@lang('trs.new_rfp')</h4>
                            </div>
                            <form action="{{route('user_rfp_store',['rfp'=>$rfp->id])}}"
                                  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="create_rfp_title">
                                    <h6>@lang('trs.rfp_title') : {{$rfp->title}}</h6>
                                </div>
                                <div class="rfp_description">
                                    <label for="description" class="form-label">@lang('trs.description')</label>
                                    <textarea name="description" class="form-control" id="description"
                                              placeholder="@lang('trs.description')"></textarea>
                                </div>
                                <div class="rfp_attachment">
                                    <input type="file" name="proposal" class="form-control" id="file">
                                </div>

                                <div class="rfp_submit">
                                    <button type="submit">@lang('trs.send')</button>
                                </div>
                            </form>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

@endsection
