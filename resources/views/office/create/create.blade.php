@extends('layouts.office_panel')

@section('content')

    <div class="mg-office_container">

        <div class="mg-office--new">
            <form action="{{route('mg.office_store')}}" method="post">
                {{csrf_field()}}

                <div class="mg-office--title">
                    <p>
                        @lang('trs.add_new_office')
                    </p>
                </div>

                <div class="row m-0">
                    <div class="col-12 col-lg-6">
                        <div class="mg-office--item">
                            <input type="text" name="name" value="{{old('name')}}"
                                   placeholder="@lang('trs.name')">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mg-office--item">
                            <input type="text" name="email" value="{{old('email')}}"
                                   placeholder="@lang('trs.email')">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mg-office--item">
                            <input type="number" name="projects_count" value="{{old('projects_count')}}"
                                   placeholder="@lang('trs.projects_count')">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mg-office--item">
                            <input type="text" name="phone" value="{{old('phone')}}"
                                   placeholder="@lang('trs.phone')">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mg-office--item">
                            <select class="form-select" name="department">
                                <option>@lang('trs.department')...</option>
                                @foreach($departments as $department)
                                    <option
                                        value="{{$department->id}}" {{old('department')==$department->id ? "selected" : ""}}>{{$department->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="mg-office--item">
                            <textarea name="about" placeholder="@lang('trs.about')">{{old('about')}}</textarea>

                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-6">
                            <div class="mg-office--item">
                                <input type="submit" class="submit" value="@lang('trs.submit')">
                            </div>

                        </div>
                    </div>

                </div>


            </form>
        </div>

    </div>

@endsection
