<div class="footer">
    <div class="row">
        <div class="col">
            <div class="footer_logo">
                <img src="{{$setting->logo}}" title="{{$setting->title}}" alt="{{$setting->title}}">
            </div>
            <div class="footer_about">
                @lang('trs.footer_description_text')
            </div>
        </div>
        <div class="col">
            <div class="footer_title">
                <span>منو</span>
            </div>
            <ul>
                <li><a href="{{route('index')}}">@lang('trs.site_main_page')</a></li>
                <li><a href="{{route('offices')}}">@lang('trs.technology_service_center')</a></li>
                <li><a href="{{route('login','member')}}">@lang('trs.member_panel') </a></li>
                <li><a href="{{route('login','user')}}">@lang('trs.user_panel')</a></li>
            </ul>
        </div>
        <div class="col">
            <div class="footer_title">
                <span>لینک های مفید</span>
            </div>
            <ul>
                <li><a href="https://aut.ac.ir/">سایت دانشگاه</a></li>
                <li><a href="https://industry.aut.ac.ir/">سایت ارتباط با صنعت</a></li>
                <li><a href="https://itech.aut.ac.ir/">سایت همپا</a></li>
            </ul>
        </div>
    </div>

    <div class="copy_right">
        <span>کلیه حقوق مادی و معنوی این وبسایت متعلق به صنایع پژوهش و فناوری های فائق میباشد.</span>
    </div>
</div>
