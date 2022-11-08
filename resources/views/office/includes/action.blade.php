<div class="action_container">

    @if(isset($edit))
        <div class="action_item">
            <a href="{{$edit}}">
                <i class="fa-solid fa-user-pen" title="@lang('trs.edit')"></i>
            </a>
        </div>
    @endif

    @if (isset($remove))

        <div class="action_item">
            <a href="{{$remove}}">
                <i class="fa-solid fa-user-xmark" title="@lang('trs.remove')"></i>
            </a>
        </div>
    @endif

    @if (isset($show))

        <div class="action_item">
            <a href="{{$show}}">
                <div class="show_action">
                    <span>@lang('trs.show')</span>
                </div>
            </a>
        </div>
    @endif

    @if (isset($send_proposal))
        <div class="action_item">
            <a href="{{$send_proposal}}">
                <div class="show_action">
                    <span>@lang('trs.send_proposal')</span>
                </div>
            </a>
        </div>
    @endif

    @if (isset($modal))
        <div class="action_item">
            <a data-bs-toggle="modal" data-bs-target="#{{$modal}}"
               href="#">
                <div class="show_action">
                    <span>{{$modal_title}}</span>
                </div>
            </a>
        </div>
    @endif

        @if (isset($file))
            <div class="action_item">
                <a href="{{$file}}">
                    <div class="download_action">
                        <span>@lang('trs.download')</span>
                    </div>
                </a>
            </div>
        @endif

</div>
