@foreach($proposals as $proposal)
    <div class="modal fade" id="proposal{{$proposal->id}}" tabindex="-1"
         aria-labelledby="proposal{{$proposal->id}}Label"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="proposal{{$proposal->id}}Label">@lang('trs.proposal')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="proposal_modal--rfp-title">
                        <h6>@lang('trs.proposal_for_rfp_with_title') : {{$proposal->rfp->title}}</h6>
                    </div>
                    <div class="proposal_modal--title">
                        <p>{{$proposal->title}}</p>
                    </div>
                    <div class="proposal_modal--description">
                        <p class=""><i class="fa-solid fa-circle-check"></i> {{$proposal->description}}</p>
                    </div>
                    @if ($proposal->file)
                        <div class="proposal_modal--file">
                            <a href="{{$proposal->file}}">@lang('trs.download_file')</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endforeach
