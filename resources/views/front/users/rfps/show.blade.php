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

                        <div class="show_rfp--container">
                            <div class="show_rfp--title">
                                <h6>@lang('trs.rfp_title') : {{$rfp->title}}</h6>
                                <p>@lang('trs.short_title') : {{$rfp->short_title}}</p>
                                <p>@lang('trs.goals') : {{$rfp->goals}}</p>
                                <p>@lang('trs.achievements') : {{$rfp->achievements}}</p>
                            </div>
                            <div class="show_rfp--body">
                                <div class="show_rfp--description">
                                    <div class="show_rfp--description--title">@lang('trs.your_rfp')
                                    </div>
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
                                    @if ($document->type=="rfp" || $document->status=="sent")
                                        <div
                                            class="show_rfp--description {{$document->type=='proposal' ? 'show_rfp--revers' : ''}}">
                                            @if ($document->type=='proposal')
                                                <div class="show_rfp--description--title">@lang('trs.proposal_sent_by')
                                                    : {{$rfp->office->name}}</div>
                                            @else
                                                <div class="show_rfp--description--title">@lang('trs.your_rfp')</div>
                                            @endif
                                            <div class="show_rfp--item">
                                                <p>{{$document->text}}</p>
                                                @if ($document->file)
                                                    <div class="show_rfp--description--file">
                                                        <a href="{{$document->file}}"><i
                                                                class="fa-solid fa-file-pdf"></i> @lang('trs.download_file')
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            <div class="show_rfp--send">
                                <a href="{{route('user_rfp_create',['rfp'=>$rfp->id])}}">
                                    @lang('trs.new_rfp')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

@endsection
