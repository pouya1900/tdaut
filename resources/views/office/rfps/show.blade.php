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

                    <div class="show_rfp--container">
                        <div class="show_rfp--title">
                            <h6>@lang('trs.rfp_title') : {{$rfp->title}}</h6>
                            <p>@lang('trs.short_title') : {{$rfp->short_title}}</p>
                            <p>@lang('trs.goals') : {{$rfp->goals}}</p>
                            <p>@lang('trs.achievements') : {{$rfp->achievements}}</p>
                        </div>
                        <div class="show_rfp--body">
                            <div class="show_rfp--description show_rfp--revers">
                                <div class="show_rfp--description--title">@lang('trs.rfp_sent_by')
                                    : {{$rfp->user->profile->fullName}}</div>
                                <div class="show_rfp--item">
                                    <p>{{$rfp->description}}</p>
                                    @if ($rfp->file)
                                        <div class="show_rfp--description--file">
                                            <a href="{{$rfp->file}}"><i
                                                    class="fa-solid fa-file-pdf"></i> @lang('trs.download_file')</a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            @foreach($rfp->documents as $document)
                                <div class="show_rfp--description {{$document->type=='rfp' ? 'show_rfp--revers' : ''}}">
                                    @if ($document->type=='rfp')
                                        <div class="show_rfp--description--title">@lang('trs.rfp_sent_by')
                                            : {{$rfp->user->profile->fullName}}</div>
                                    @else
                                        <div class="show_rfp--description--title">@lang('trs.your_proposal')</div>
                                    @endif
                                    <div class="show_rfp--item">
                                        <p>{{$document->text}}</p>
                                        @if ($document->file)
                                            <div class="show_rfp--description--file">
                                                <a href="{{$document->file}}"><i
                                                        class="fa-solid fa-file-pdf"></i> @lang('trs.download_file')</a>
                                            </div>
                                        @endif

                                        @if ($document->type=='proposal' && $document->status=='pending')
                                            @if ($current_member->id==$office->head->id)
                                                <div class="rfp_show--send">
                                                    <a href="{{route('mg.rfp.send',['office'=>$office->id,'document'=>$document->id])}}">@lang('trs.send')</a>
                                                    <a href="{{route('mg.rfp.delete',['office'=>$office->id,'document'=>$document->id])}}">@lang('trs.remove')</a>
                                                </div>
                                            @else
                                                <div class="rfp_show--send">
                                                    <div class="rfp_show--send--alarm" data-bs-toggle="tooltip"
                                                         data-bs-placement="top"
                                                         data-bs-title="@lang('trs.proposal_submitted_not_sent')">
                                                        <i class="fa-solid fa-info"></i>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="show_rfp--send">
                            <a href="{{route('mg.create_proposal',['office'=>$office->id,'rfp'=>$rfp->id])}}">
                                @lang('trs.new_proposal')
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection
