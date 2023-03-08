<div class="office_menu">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left links -->
                <ul class="navbar-nav me-auto ps-lg-0" style="padding-left: 0.15rem">
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{route('office_members',['office'=>$office->id,'type'=>'head'])}}">ریاست</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{route('office_members',['office'=>$office->id,'type'=>'board'])}}">اعضای
                            هیئت مدیره</a>
                    </li>
                    <!-- Navbar dropdown -->
                    <li class="nav-item dropdown dropdown-hover position-static">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-mdb-toggle="dropdown" aria-expanded="false">
                            محصولات
                        </a>
                        <!-- Dropdown menu -->
                        <div class="dropdown-menu mt-0" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;
                            border-top-right-radius: 0;
                          ">

                            <div class="container">

                                <div class="list-group list-group-flush">
                                    @foreach($office->categoriesList as $category)
                                        <a href="{{route('office_products',['office'=>$office->id,'category'=>$category->id])}}"
                                           class="list-group-item list-group-item-action">{{$category->title}}</a>
                                    @endforeach
                                    <a href="{{route('office_products',['office'=>$office->id])}}"
                                       class="list-group-item list-group-item-action">@lang('trs.all')</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a data-bs-toggle="modal" data-bs-target="#capabilityModal" class="nav-link"
                           href="#">@lang('trs.capabilities')</a>
                    </li>

                    <li class="nav-item">
                        @if ($current_user)
                            <a class="nav-link" href="{{route('office_rfp',$office->id)}}">
                                @lang('trs.submit_rfp')
                            </a>
                        @else
                            <a data-bs-toggle="modal" data-bs-target="#rfpModal" class="nav-link"
                               href="#">@lang('trs.submit_rfp')</a>
                        @endif

                    </li>


                    <li class="nav-item dropdown dropdown-hover position-static">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-mdb-toggle="dropdown" aria-expanded="false">
                            ارتباط با ما
                        </a>
                        <!-- Dropdown menu -->
                        <div class="dropdown-menu mt-0" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;
                            border-top-right-radius: 0;
                          ">

                            <div class="container">

                                <div class="list-group list-group-flush">
                                    <a href="{{route('office_contact',$office->id)}}"
                                       class="list-group-item list-group-item-action">اطلاعات تماس</a>
                                    @if ($current_user)

                                        <a href="{{route('office_chat',$office->id)}}"
                                           class="list-group-item list-group-item-action">@lang('trs.chat')</a>
                                    @else
                                        <a data-bs-toggle="modal" data-bs-target="#chatModal" class="nav-link"
                                           href="#">@lang('trs.chat')</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </li>


                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
</div>
