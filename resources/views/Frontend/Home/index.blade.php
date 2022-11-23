@extends('Frontend.layouts.main')
@section('main-content')


@foreach($category as $cat_row)
@php
    $posts = Helper::getPosts($cat_row->category_id,10);
@endphp
@if(count($posts) > 0)
<section class="carousel_se_01">
    <div class="container-fluid ">
            <div class="row pt-3">
                <div class="col-md-12 px-0">
                        <div class="category_header row p-2">
                            <div class="category_header_left col-md-6">
                                <h2 class="text-dark" >{{$cat_row->category_name}}</h2>
                            </div>
                            <div class="category_header_right d-flex flex-row-reverse  col-md-6">
                                <div class="view_all_btn">
                                    <a href="{!! url('/').'/category/'.$cat_row->category_name.'/'.Helper::base64url_encode($cat_row->category_id) !!}" >View all</a>
                                </div>
                            </div>
                            
                        </div>
                        <div class="owl-carousel carousel_se_01_carousel owl-theme">
                            <!-- 1 -->
                            @foreach($posts as $post_row)
                            <div class="item">
                                <div class="col-md-12 wow fadeInUp ">
                                    <div class="main_services text-left">
                                        <a href="{!! url('detail/'.$post_row->post_url.'/'.Helper::base64url_encode($post_row->post_id)) !!}">
                                            <div class="img-thumbnail text-center">
                                                <img src="{{url($post_row->img_path)}}" class="img-thumbnail" height="142px" alt="">
                                            </div>
                                            <div class="card_detail">
                                                <h4 class="mt-3 card_title_ellipsis">{{ $post_row->title }}</h4>
                                                <p class="card_text_ellipsis" >{!! strip_tags($post_row->description) !!}</p>

                                            
                                        </a>
                                        <div class="card_footer row">
                                            <div class="col-6 text-grey">
                                                {!! Helper::formatDate($post_row->published_date) !!}
                                            </div>
                                            <div class="col-6 d-flex flex-row-reverse">
                                                <div class="post_category">
                                               
                                                {{ $cat_row->category_name }}
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                           
                            <!-- 1 end  -->
                        </div> <!-- owl-carousel end -->
                        <!-- <div class="hr col-6 mx-auto"></div> -->
                </div> <!-- col-md-12 end -->
            </div> <!-- row end -->
    </div> <!-- container-fluid end -->
</section> <!-- Section end -->
@endif
@endforeach

@endsection