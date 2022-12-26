@extends('layouts.office')
@section('content')

    <div class="page_wrapper">
        <div class="container">
            <div class="offices_container">
                <div class="rfp_content">
                    <div class="rfp_header">
                        <h4>درخواست پروپوزال</h4>
                    </div>
                    <form action="{{route('office_store_rfp',$office->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="rfp_title">
                            <label for="title" class="form-label">@lang('trs.title')</label>
                            <input type="text" name="title" class="form-control" id="title"
                                   placeholder="@lang('trs.title')">
                        </div>
                        <div class="rfp_title">
                            <label for="short_title" class="form-label">@lang('trs.short_title')</label>
                            <input type="text" name="short_title" class="form-control" id="short_title"
                                   placeholder="@lang('trs.short_title')">
                        </div>
                        <div class="rfp_description">
                            <label for="description" class="form-label">@lang('trs.description')</label>
                            <textarea name="description" class="form-control" id="description"
                                      placeholder="@lang('trs.description')"></textarea>
                        </div>
                        <div class="rfp_description">
                            <label for="goals" class="form-label">@lang('trs.goals')</label>
                            <textarea name="goals" class="form-control" id="goals"
                                      placeholder="@lang('trs.goals')"></textarea>
                        </div>
                        <div class="rfp_description">
                            <label for="achievements" class="form-label">@lang('trs.achievements')</label>
                            <textarea name="achievements" class="form-control" id="achievements"
                                      placeholder="@lang('trs.achievements')"></textarea>
                        </div>
                        <div class="rfp_attachment">
                            <input type="file" name="rfp" class="form-control" id="file">
                        </div>

                        <div class="rfp_submit">
                            <button type="submit">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
