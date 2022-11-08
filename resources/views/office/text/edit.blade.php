@extends('layouts.office_panel')

@section('style')

@endsection

@section('content')

    <div class="row m-0 full-height">

        @include('office.includes.side_bar')

        <div class="col-12 col-lg-10 p-0">
            <div class="mg-office-dashboard">

                @include('office.includes.error_message')


                <form action="{{route('mg.content_update',$office->id)}}" method="post">
                    {{csrf_field()}}
                    <textarea class="" rows="4" id="office_content"
                              name="content">
                        {!! $office->content !!}
                    </textarea>

                    <div class="content_edit--submit">
                    <button type="submit" class="edit_profile_button">
                        @lang('trs.submit')
                    </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')

    <script
        src="storage/js/tinymce.min.js?apiKey=lspn926evhqnjbunloefdwuyjkll6j9q085tshnm9uhpaexi"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code help'
            ],
            toolbar1: ' styleselect | fontselect | fontsizeselect | searchreplace insertdatetime charmap | bold italic underline strikethrough subscript superscript | alignleft aligncenter alignright alignjustify |  bullist numlist | forecolor backcolor | blockquote link unlink table | image media  | code preview ',
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ],

            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,

            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css']
        });
    </script>

@endsection
