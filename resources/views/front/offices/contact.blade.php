@extends('layouts.office')
@section('content')
    @include('front.offices.menu')

    <div class="page_wrapper">
        <div class="offices_container">

            <div class="contact_container">
                @if ($office->phone)
                    <p>تلفن : {{$office->phone}}</p>
                @endif
                @if ($office->email)
                    <p>ایمیل : {{$office->email}}</p>
                @endif
                @if ($office->admin_contact)
                    <p>تماس مستقیم با رئیس : {{$office->admin_contact}}</p>
                @endif
                @if ($office->address)
                    <p>ادرس : {{$office->address}}</p>
                @endif
            </div>

        </div>
    </div>

@endsection
