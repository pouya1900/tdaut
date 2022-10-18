@extends('layouts.office_panel')

@section('style')
    {{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">--}}
    <link rel="stylesheet" type="text/css" href="storage/css/jquery.dataTables.css">
@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">

                @include('office.members.table')

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" charset="utf8"
            {{--            src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>--}}
            src="storage/js/jquery.dataTables.js"></script>

    <script>
        $('#datatable').DataTable({
            language: {
                url: 'storage/json/fa.json'
            },
        });
    </script>
@endsection
