<div class="modal fade" id="rfpModal" tabindex="-1" aria-labelledby="rfpModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="capabilityModalLabel">@lang('trs.submit_rfp')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    @lang('trs.submit_rfp_need_login_as_user')
                </p>

                <div class="login_register_modal">
                    <p>
                        <a href="{{route('login','user')}}">@lang('trs.login_to_account')</a>
                    </p>
                    <p>
                        <a href="{{route('register_user')}}">@lang('trs.not_registered_yet')</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="capabilityModalLabel">@lang('trs.chat')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    @lang('trs.chat_need_login_as_user')
                </p>

                <div class="login_register_modal">
                    <p>
                        <a href="{{route('login','user')}}">@lang('trs.login_to_account')</a>
                    </p>
                    <p>
                        <a href="{{route('register_user')}}">@lang('trs.not_registered_yet')</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
