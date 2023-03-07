@extends('layouts.office')
@section('style')
    <link rel="stylesheet" href="storage/css/gallery.css">
@endsection

@section('content')
    @include('front.offices.menu')

    <div class="page_wrapper">
        <div class="container">
            <div class="product_show">
                <div class="row">
                    <div class="col-6">
                        <div class="product_show--body">
                            <div class="product_show--logo">
                                <img src="{{$product->logo}}" alt="{{$product->title}}">
                            </div>
                            <div class="product_show--info">
                                <div class="product_show--title">
                                    <p>@lang('trs.title') : {{$product->title}}</p>
                                </div>
                                <div class="product_show--office">
                                    <p> @lang('trs.office') : <a
                                            href="{{route('office_show',$product->office->id)}}"> {{$product->office->name}}</a>
                                    </p>
                                </div>
                                <div class="product_show--category">
                                    <p> @lang('trs.category')
                                        : {{$product->category->title}}
                                    </p>
                                </div>
                                @if ($product->tags->first())
                                    <div class="product_show--tags">
                                        <p>@lang('trs.tags') :
                                            @php($i=0)
                                            @foreach($product->tags as $tag)
                                                {{$i ? "," : ""}}
                                                {{$tag->title}}
                                                @php($i++)
                                            @endforeach
                                        </p>
                                    </div>
                                @endif

                                @if ($product->link)
                                    <div class="product_show--link">
                                        <p>@lang('trs.demo_link') : {{$product->link}}
                                        </p>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="product_gallery--container">
                            @include('front.products.images')
                        </div>
                    </div>
                </div>


                <div class="product_show_tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description-tab-pane" type="button" role="tab"
                                    aria-controls="description-tab-pane" aria-selected="true">
                                @lang('trs.description')
                            </button>
                        </li>

                        @if ($product->td)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="td_view-tab" data-bs-toggle="tab"
                                        data-bs-target="#td_view-tab-pane" type="button" role="tab"
                                        aria-controls="td_view-tab-pane"
                                        aria-selected="false">
                                    @lang('trs.td_view')
                                </button>
                            </li>
                        @endif

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel"
                             aria-labelledby="description-tab" tabindex="0">

                            <div class="product_show--description--container">
                                <div class="product_show--section-title">
                                    <h6>@lang('trs.description')</h6>
                                </div>
                                <p class="margin-right-10">{{$product->description}}</p>
                            </div>
                            <div class="product_show--video--container">
                                <div class="product_show--section-title">
                                    <h6>@lang('trs.video')</h6>
                                </div>
                                <video controls>
                                    <source src="{{$product->video}}">
                                </video>
                            </div>

                            <div class="product_show--catalog--container">
                                <div class="product_show--section-title">
                                    <h6>@lang('trs.catalog')</h6>
                                </div>
                                <a href="{{$product->catalog}}"><i
                                        class="fa-solid fa-file-pdf"></i> @lang('trs.download_catalog')</a>
                            </div>
                        </div>


                        @if ($product->td)
                            <div class="tab-pane fade" id="td_view-tab-pane" role="tabpanel"
                                 aria-labelledby="td_view-tab"
                                 tabindex="0">
                                <div class="product_show--td_view--container">
                                    <div id="app">
                                        <product-td :path="{{json_encode($product->tdPath)}}"
                                                    :file_name="{{json_encode($product->tdModel->title)}}"></product-td>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript" src="storage/js/gallery.js"></script>


    <script async src="https://unpkg.com/es-module-shims@1.3.6/dist/es-module-shims.js"></script>

    <script type="importmap">
  {
    "imports": {
      "three": "https://cdn.jsdelivr.net/npm/three@0.140.0/build/three.module.min.js"
    }
  }












    </script>

@endsection
