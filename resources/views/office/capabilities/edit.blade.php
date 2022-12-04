@extends('layouts.office_panel')

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <form action="{{route('mg.office_capabilities_update',$office->id)}}" method="post">
                    {{csrf_field()}}
                    @include('front.partials.error_message')

                    <div id="capability">
                        <capability :data="{{json_encode($office->capabilities)}}">
                        </capability>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-4 text-center">
                            <button type="submit" class="edit_profile_button">
                                @lang('trs.submit')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
