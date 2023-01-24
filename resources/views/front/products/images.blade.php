<!-- Container for the image gallery -->
@if ($product->images)
    <div class="container">

        <!-- Full-width images with number text -->
        @php($total=count($product->images))
        @php($i=1)
        @foreach($product->images as $image)
            <div class="mySlides">
                <div class="numbertext">{{$i}} / {{$total}}</div>
                <img src="{{$image}}" style="width:100%">
            </div>
        @php($i++)
    @endforeach



    <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <!-- Image text -->
        <div class="caption-container">
            <p id="caption"></p>
        </div>

        <!-- Thumbnail images -->
        <div class="row">
            @php($i=1)
            @foreach($product->images as $image)
                <div class="column">
                    <img class="demo cursor" src="{{$image}}" style="width:100%" onclick="currentSlide({{$i}})">
                </div>
                @php($i++)
            @endforeach
        </div>
    </div>
@endif
