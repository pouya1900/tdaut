@extends('layouts.office_panel')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <div class="my-table">
                    @include('office.includes.error_message')

                    <div class="rfp_content">
                        <div class="rfp_header">
                            <h4>پروپوزال</h4>
                        </div>
                        <form action="{{route('mg.store_proposal',['office'=>$office->id,'document'=>$document->id])}}"
                              method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="rfp_title">
                                <label for="title" class="form-label">@lang('trs.proposal_title')</label>
                                <input type="text" name="title" class="form-control" id="title"
                                       placeholder="@lang('trs.proposal_title')">
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

@endsection

@section('script')

@endsection
