@extends('layouts.office_panel')

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">
                <form action="{{route('mg.office_capabilities_update',$office->id)}}" method="post">
                    {{csrf_field()}}
                    @if (count($errors))
                        <div class="alert alert-danger alert-dismissible login_form--alert" role="alert">
                            <strong>{{ $errors->first() }}</strong>
                        </div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible register_form--alert" role="alert">
                            <strong>{{ session('message') }}</strong>
                        </div>
                    @endif
                    <div class="row justify-content-center m-0">
                        @if ($office->capabilities)
                            @foreach($office->capabilities as $capability)
                                <div class="col-12 col-lg-8">
                                    <div class="mg-office--item">
                                        <input type="text" name="capabilities[]" value="{{$capability->text}}"
                                               placeholder="@lang('trs.capability')">
                                        <button type="button" class="delete_capability">-</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="mg-office--item">
                        <button type="button"  name="add_capability" id="add_capability">+</button>
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
