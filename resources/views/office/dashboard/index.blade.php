@extends('layouts.office_panel')

@section('content')
    <div class="row m-0 full-height">
        @php($count=0)
        @php($wizard=15)
        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <div class="wizard_container">
                    <div class="activate_alarm">
                        @if ($office->status=="created")
                            <p>
                                @lang('trs.office_not_verified_yet_complete_information_and_request')
                            </p>
                            <div class="request_to_verify">
                                <a href="{{route('mg.office_request',$office->id)}}">درخواست بررسی</a>
                            </div>
                        @elseif ($office->status=="pending")
                            <p>
                                @lang('trs.office_not_verified_yet_pending')
                            </p>
                        @elseif ($office->status=="rfd")
                            <p>
                                @lang('trs.office_not_verified_yet_need_document')
                            </p>
                            <div class="activate_alarm--rfd">
                                {{$office->status_message}}
                            </div>
                            <div class="request_to_verify">
                                <a href="{{route('mg.office_request',$office->id)}}">درخواست بررسی</a>
                            </div>
                        @elseif ($office->status=="rejected")
                            <p>
                                @lang('trs.office_rejected')
                            </p>
                            <div class="activate_alarm--rfd">
                                {{$office->status_message}}
                            </div>
                        @endif

                    </div>
                    <div class="office_wizard">
                        <div class="row m-0">
                            <div class="wizard_item col">
                                <p class="wizard_item_title"><a href="{{route('mg.office',$office->id)}}">@lang('trs.office_logo')</a></p>
                                @if ($office->hasLogo)
                                    @php($count+=$wizard+5)
                                    <p><i class="fa-solid fa-check"></i></p>
                                @else
                                    <p><i class="fa-solid fa-xmark"></i></p>
                                @endif
                            </div>
                            <div class="wizard_item col">
                                <p class="wizard_item_title"><a href="{{route('mg.office',$office->id)}}">@lang('trs.slide_show')</a></p>
                                @if ($office->hasSlideshow)
                                    @php($count+=$wizard)
                                    <p><i class="fa-solid fa-check"></i></p>
                                @else
                                    <p><i class="fa-solid fa-xmark"></i></p>
                                @endif
                            </div>
                            <div class="wizard_item col">
                                <p class="wizard_item_title"><a href="{{route('mg.office_capabilities',$office->id)}}">@lang('trs.capabilities')</a></p>
                                @if ($office->capabilities->count())
                                    @php($count+=$wizard)
                                    <p><i class="fa-solid fa-check"></i></p>
                                @else
                                    <p><i class="fa-solid fa-xmark"></i></p>
                                @endif
                            </div>
                            <div class="wizard_item col">
                                <p class="wizard_item_title"><a href="{{route('mg.office_members',$office->id)}}">@lang('trs.members')</a></p>
                                @if ($office->members->count() > 1)
                                    @php($count+=$wizard)
                                    <p><i class="fa-solid fa-check"></i></p>
                                @else
                                    <p><i class="fa-solid fa-xmark"></i></p>
                                @endif
                            </div>
                            <div class="wizard_item col">
                                <p class="wizard_item_title"><a href="{{route('mg.content_edit',$office->id)}}">@lang('trs.content')</a></p>
                                @if ($office->content)
                                    @php($count+=$wizard)
                                    <p><i class="fa-solid fa-check"></i></p>
                                @else
                                    <p><i class="fa-solid fa-xmark"></i></p>
                                @endif
                            </div>
                            <div class="wizard_item col">
                                <p class="wizard_item_title"><a href="{{route('mg.products',$office->id)}}">@lang('trs.products')</a></p>
                                @if ($office->products->count())
                                    @php($count+=$wizard+5)
                                    <p><i class="fa-solid fa-check"></i></p>
                                @else
                                    <p><i class="fa-solid fa-xmark"></i></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="completion">
                        <p>
                            @lang('trs.your_office_complete_number',['count'=>$count])
                        </p>
                    </div>
                    <div class="summery">
                        <div class="row">
                            <div class="col-6">
                                <span>@lang('trs.number_of_members') : {{$office->members->count()}}</span>
                            </div>
                            <div class="col-6">
                                <span>@lang('trs.number_of_products') : {{$office->products->count()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
