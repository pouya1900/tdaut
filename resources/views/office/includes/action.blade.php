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


</div>
