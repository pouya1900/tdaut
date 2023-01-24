@extends('layouts.office_panel')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <div class="my-table">
                    @include('front.partials.error_message')

                    <div class="rfp_content">
                        <div class="rfp_header">
                            <h4>پروپوزال</h4>
                        </div>
                        <form action="{{route('mg.store_proposal',['office'=>$office->id,'rfp'=>$rfp->id])}}"
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
                                @if ($current_member->id==$office->head->id)
                                    <button type="submit">@lang('trs.send')</button>
                                @else
                                    <button type="submit">@lang('trs.submit')</button>
                                    <p>@lang('trs.you_can_submit_proposal_but_head_must_send')</p>
                                @endif

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
