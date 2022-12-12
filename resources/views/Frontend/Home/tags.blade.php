@extends('Frontend.layouts.main')
@section('main-content')


@if(count($posts) > 0)
@php
    $cat_row = json_decode($posts[0]->category);
@endphp
@if($cat_row && $cat_row[0]->category_status == 1)
<section class="carousel_se_01">
    <div class="container-fluid ">
            <div class="row pt-3">
                <div class="col-md-12">
                        <div class="category_header row p-2">
                            <div class="col-md-3"><hr class="bg-colorAccent"></div>
                            <div class="category_header_left col-md-3  text-center">
                            <h2 class="colorAccent" >{{$cat_row[0]->category_name}}</h2>
                            </div>
                            <div class="col-md-3"><hr class="bg-colorAccent"></div>
                        </div>
                        <div class="row">
                        <div class="row col-md-11 col-lg-10" id="post-box">
                        <!-- 1 -->
                        <div class="row" id="post-data">
                            <!-- 1 -->
                            @include('Frontend.Home.post-data')
                        </div>
                        <div class=" col-md-12 pb-2 text-center">
                            <div class="loader" id="loader">
                                <lottie-player src="{{url('/loaderjson.json')}}" background="transparent" speed="1"
                                    style="height: 100px; display:none;" loop autoplay class="loading"></lottie-player>
                            </div>
                        </div>
                        <!-- 1 end  -->
                    </div> <!--post box end -->
                            
                            <div class="col-md-6 col-lg-2 right_sidebar">
                                @include('Frontend.layouts.sidebar')
                            </div>
                        </div>
                </div> <!-- col-md-12 end -->
            </div> <!-- row end -->
    </div> <!-- container-fluid end -->
</section> <!-- Section end -->
@else
<h2 class="te   xt-danger" >No Record Found</h2>
@endif
@else
<h2 class="text-danger" >No Record Found</h2>
@endif
<br><br>
@endsection


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
function loadMoreData(page) {
    $.ajax({
            url: "?page=" + page,
            type: "get",
            beforeSend: function() {
                $(".lodermsg").show();
            }
        })
        .done(function(data) {
            if (data.html === " ") {
                $('.loading').hide();
                return;
            }
            console.log(data)
            $(".loading").hide();
            $("#post-data").append(data.html);

        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log("Server not responding....")
        });
}

var page = 1;

$(window).on('scroll', function() {
    if ($(window).scrollTop() >= $(
            '#post-box').offset().top + $('#post-box').outerHeight() - window.innerHeight) {
        page++;
        loadMoreData(page);
    }
});
</script>