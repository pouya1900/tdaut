@extends('layouts.office')
@section('content')

    <div class="page_wrapper">
        <div class="container">
            <div class="offices_container">
                <div class="rfp_content">
                    <div class="rfp_header">
                        <h4>درخواست پروپوزال</h4>
                    </div>
                    <form action="{{route('office_store_rfp',$office->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="rfp_title">
                            <label for="title" class="form-label">عنوان پروژه</label>
                            <input type="text" name="title" class="form-control" id="title"
                                   placeholder="عنوان پروژه">
                        </div>
                        <div class="rfp_description">
                            <label for="description" class="form-label">توضیحات</label>
                            <textarea name="description" class="form-control" id="description"
                                      placeholder="توضیحات"></textarea>
                        </div>
                        <div class="rfp_attachment">
                            <input type="file" name="rfp" class="form-control" id="file">
                        </div>

                        <div class="rfp_submit">
                            <button type="submit">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
