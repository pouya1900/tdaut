@foreach($rfps as $rfp)
    <div class="modal fade" id="description{{$rfp->id}}" tabindex="-1" aria-labelledby="description{{$rfp->id}}Label"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="description{{$rfp->id}}Label">@lang('trs.description')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class=""><i class="fa-solid fa-circle-check"></i> {{$rfp->description}}</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
