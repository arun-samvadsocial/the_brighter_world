@extends('Frontend.layouts.main')
@section('main-content')

<style>
    .thumb {
        width: 100%;
        max-height: 465px;
        border-radius: 10px;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .main-news {
        margin-top: 20px;
        max-width: 1500px;
    }

    .main-news h3 {
        line-height: 0.75;
    }

    .main-news h3 a {
        font-size: 17px;
        text-decoration: none;
        font-weight: 600;
    }

    .image {
        overflow: hidden;
        border-radius: 10px;
    }

    .image-sm {
        max-height: 280px
    }

    .image-sm img {
        height: 180px;

    }

    .image-xs {
        max-height: 140px;
    }

    .image-xxs {
        max-height: 100px;
    }

    .image img {
        object-fit: cover;
    }

    .font-large {
        font-size: 0.8em !important;
        font-weight: 600 !important;
    }

    .title-container {
        position: absolute;
        bottom: 0px;
        left: 15px;
        padding: 15px 20px 15px 20px;
    }

    .title-container a {
        color: white;
    }

    .custom {
        margin-left: 0px;
        margin-right: 0px;
        padding-left: 0px;
        padding-right: 0px;
    }
</style>
<!-- Hero section start here  -->
@php
$trending_post = Helper::getTrendingPosts(4);
$trending_cat_row = json_decode($trending_post[0]->category);
@endphp
@if($trending_cat_row)
<div class="container main-news section">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6">
            <img class="thumb mb-3 main-thumb " src="{{url($trending_post[0]->img_path)}}"
                style="object-fit: cover; min-height:465px;">
            <div class="overlay">
                <h3 class="mb-4 title-container">
                    <a class="font-large"
                        href="{!! url('detail/'.$trending_post[0]->post_url.'/'.Helper::base64url_encode($trending_post[0]->post_id)) !!}">
                        {{ $trending_post[0]->title }}
                    </a>
                    <br>
                    <div class="row" style="color:white;font-size: 18px;margin-top: 15px;">
                        <span class="m-r-0" style="margin: 0px 10px;"><i
                                class="fa fa-eye"></i>{{$trending_post[0]->post_view_count}}</span>
                        <span style="margin:3px;">{!! Helper::formatDate($trending_post[0]->published_date) !!}</span>
                        <a href="{!! url('/').'/category/'.$trending_post[0]->category_name.'/'.Helper::base64url_encode($trending_post[0]->category_id) !!}" style="font-size:12px;margin-top: -8px;margin-left: 5px;"
                            class="btn btn-warning rounded-pill">{{$trending_post[0]->category_name}}</a>
                    </div>
                </h3>
            </div>

        </div>
        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                    <div class="image image-sm mb-1">
                        <img class="thumb" src="{{url($trending_post[1]->img_path)}}" style="height:100%;">
                    </div>
                    <h3 class="mb-4 title-container">
                        <a
                            href="{!! url('detail/'.$trending_post[1]->post_url.'/'.Helper::base64url_encode($trending_post[1]->post_id)) !!}">
                            {{ $trending_post[1]->title }}
                        </a>
                        <br>
                        <div class="row" style="color:white;font-size: 18px;margin-top: 15px;">
                            <span class="m-r-0" style="margin: 0px 10px;"><i
                                    class="fa fa-eye"></i>{{$trending_post[1]->post_view_count}}</span>
                            <span style="margin:3px;">{!! Helper::formatDate($trending_post[1]->published_date)
                                !!}</span>
                            <a href="{!! url('/').'/category/'.$trending_post[1]->category_name.'/'.Helper::base64url_encode($trending_post[1]->category_id) !!}" style="font-size:12px;margin-top: -8px;margin-left: 20px;"
                                class="btn btn-warning rounded-pill">{{$trending_post[1]->category_name}}</a>
                        </div>
                    </h3>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 row custom ">
                    <div class="col-lg-6 plr-2" style="padding-right:2px">
                        <div class="image image-sm mb-1">
                            <img class="thumb" src="{{url($trending_post[2]->img_path)}}">
                        </div>
                        <h3 class="mb-4 title-container">
                            <a
                                href="{!! url('detail/'.$trending_post[2]->post_url.'/'.Helper::base64url_encode($trending_post[2]->post_id)) !!}">
                                {{ $trending_post[2]->title }}
                            </a>
                            <br>
                            <div class="row" style="color:white;font-size: 18px;margin-top: 15px;">
                                <span class="m-r-0" style="margin: 0px 10px;"><i
                                        class="fa fa-eye"></i>{{$trending_post[2]->post_view_count}}</span>
                                <span style="margin:3px;">{!! Helper::formatDate($trending_post[2]->published_date)
                                    !!}</span>
                                <a href="{!! url('/').'/category/'.$trending_post[2]->category_name.'/'.Helper::base64url_encode($trending_post[2]->category_id) !!}" style="font-size:12px;margin-top: -8px;margin-left: 20px;"
                                    class="btn btn-warning rounded-pill">{{$trending_post[2]->category_name}}</a>
                            </div>
                        </h3>
                    </div>
                    <div class="col-lg-6 plr-2" style="padding-left:2px">
                        <div class="image image-sm mb-3">
                            <img class="thumb image-sm" src="{{url($trending_post[3]->img_path)}}">
                        </div>
                        <h3 class="mb-4 title-container">
                            <a
                                href="{!! url('detail/'.$trending_post[3]->post_url.'/'.Helper::base64url_encode($trending_post[3]->post_id)) !!}">
                                {{ $trending_post[3]->title }}
                            </a>
                            <br>
                            <div class="row" style="color:white;font-size: 18px;margin-top: 15px;">
                                <span class="m-r-0" style="margin: 0px 10px;"><i
                                        class="fa fa-eye"></i>{{$trending_post[3]->post_view_count}}</span>
                                <span style="margin:3px;">{!! Helper::formatDate($trending_post[3]->published_date)
                                    !!}</span>
                                <a href="{!! url('/').'/category/'.$trending_post[3]->category_name.'/'.Helper::base64url_encode($trending_post[3]->category_id) !!}" style="font-size:12px;margin-top: -8px;margin-left: 20px;"
                                    class="btn btn-warning rounded-pill">{{$trending_post[3]->category_name}}</a>
                            </div>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Hero section end here  -->

@foreach($category as $cat_row)
@php
$posts = Helper::getPosts($cat_row->category_id,10);
@endphp
@if(count($posts) > 0)


<!-- Slider section with category start here  -->
<section class="carousel_se_01">
    <div class="container-fluid ">
        <div class="row pt-3">
            <div class="col-md-12 px-0">
                <div class="category_header row p-2">
                    <div class="category_header_left col-md-6">
                        <h2 class="text-dark">{{$cat_row->category_name}}</h2>
                    </div>
                    <div class="category_header_right d-flex flex-row-reverse  col-md-6">
                        <div class="view_all_btn">
                            <a
                                href="{!! url('/').'/category/'.$cat_row->category_name.'/'.Helper::base64url_encode($cat_row->category_id) !!}">View
                                all</a>
                        </div>
                    </div>

                </div>
                <div class="owl-carousel carousel_se_01_carousel owl-theme">
                    <!-- 1 -->
                    @foreach($posts as $post_row)
                    <div class="item">
                        <div class="col-md-12 wow fadeInUp ">
                            <div class="main_services text-left">
                                <a
                                    href="{!! url('detail/'.$post_row->post_url.'/'.Helper::base64url_encode($post_row->post_id)) !!}">
                                    <div class="img-thumbnail text-center">
                                        <img src="{{url($post_row->img_path)}}" class="img-thumbnail" height="142px"
                                            alt="">
                                    </div>
                                    <div class="card_detail">


                                        <h4 class="mt-3 card_title_ellipsis" title="{{ $post_row->title }}">
                                            {{ $post_row->title }}</h4>

                                        <p class="card_text_ellipsis">{!! strip_tags($post_row->description) !!}</p>



                                </a>
                                <div class="card_footer row">
                                    <div class="col-6 text-grey">
                                        {!! Helper::formatDate($post_row->published_date) !!}
                                    </div>
                                    <div class="col-6 d-flex flex-row-reverse">
                                        <div class="post_category" style="text-align: right;">
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