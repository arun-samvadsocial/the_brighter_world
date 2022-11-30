@extends('Frontend.layouts.main')
@section('main-content')


<style>
    .img-container{
        position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    overflow: hidden;
    }
    .img-cover {
    position: relative;
    width: 100%;
    height: 100%;
    object-fit: cover;
    background-repeat:no-repeat;
    background-size: cover;
    background-position: center;
    }
    #copyright {
            position: absolute;
            color: #000;
            bottom: -28px;
            padding: 15px;
            /* left: 46%; */
            /* background-color: rgba(0,0,0,0.5); */
            background: rgba(0, 0, 0, 0) linear-gradient(to bottom, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0.36) 50%, rgb(0, 0, 0) 100%);
            }
    .caption {
        position: absolute;
        bottom: 0;
        left: 0;
        padding: 15px 20px 15px 20px;
        pointer-events: none;
        /* background-color: rgba(0,0,0,0.5); */
        background: rgba(0, 0, 0, 0) linear-gradient(to bottom, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0.36) 50%, rgb(0, 0, 0) 100%);
        width: 100%;
        
    }
    .caption .title{
        color: #fff;
        font-size: 22px;
        font-weight: 500;
        line-height: 28px;
        margin-top: 10px;
        position: relative;
        
    }
    .caption .post-meta{
        margin-bottom: 0;
        color: #fff;
        position: relative;
        z-index: 14;
    }
    
    #copyright1 {
            position: absolute;
            color: #000;
            bottom: 0px;
            padding: 10px;
            font-size:10px;
            /* left: 46%; */
            /* background-color: rgba(0,0,0,0.5); */
            background: rgba(0, 0, 0, 0) linear-gradient(to bottom, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0.36) 50%, rgb(0, 0, 0) 100%);
    }

</style>
<!-- Hero section start here  -->
@php
    $trending_post = Helper::getTrendingPosts(4);
    $trending_cat_row = json_decode($trending_post[0]->category);
@endphp
@if($trending_cat_row)
<section class="trending">
    <div class="container-fluid ">
        <div class="row pt-3">
            <div class="col-md-12 px-0">
                <div class="category_header row p-2">
                    <div class="category_header_left col-md-6">
                        <h2 class="text-dark" >Trending</h2>
                    </div>
                    <div class="category_header_right d-flex flex-row-reverse  col-md-6">
                        <div class="view_all_btn">
                            <!-- <a href="" >View all</a> -->
                        </div>
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="">
                        <div class="row m-2">
                            <div class="col-md-6 col-sm-12">
                                <!-- <div class="card"> -->
                                <a href="{!! url('detail/'.$trending_post[0]->post_url.'/'.Helper::base64url_encode($trending_post[0]->post_id)) !!}">
                                    <div class="img-container img-1">
                                        <div class="img-cover">
                                            <!-- <div class="post_image"> -->
                                                <img src="{{url($trending_post[0]->img_path)}}" class="img-cover" alt="">
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                    <div class="caption1">
                                        <h2 class="title1">{{ $trending_post[0]->title }}</h2>
                                        <p class="post-meta1">
                                            <span>{!! Helper::formatDate($trending_post[0]->published_date) !!}</span>
                                            <!-- <span><i class="fa fa-comment"></i> 0</span> -->
                                            <span class="m-r-0"><i class="fa fa-eye"></i>{{$trending_post[0]->post_view_count}}</span>
                                        </p>
                                        <div class="post_category" style="text-align: right;">
                                            <ul>
                                                <li>
                                                    <a href="#"  style="font-size:10px;" class="btn btn-warning rounded-pill">{{$trending_post[1]->category_name}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                </a>
                                    </div>
                                <!-- </div>   -->
                            </div>
                            <div class="col-md-6 col-sm-12 ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{!! url('detail/'.$trending_post[1]->post_url.'/'.Helper::base64url_encode($trending_post[1]->post_id)) !!}">
                                            <div class="card">
                                                <img src="{{url($trending_post[1]->img_path)}}" class="img-cover" alt="">                                            <div class="caption">
                                                <h2 class="title">{{ $trending_post[1]->title }}</h2>
                                                <p class="post-meta">
                                                    <span>{!! Helper::formatDate($trending_post[1]->published_date) !!}</span>
                                                    <!-- <span><i class="icon-comment"></i>0</span> -->
                                                    <span class="m-r-0"><i class="icon-eye"></i>{{$trending_post[1]->post_view_count}}</span>
                                                </p>
                                                <div class="post_category" style="text-align: right;">
                                                    <ul>
                                                        <li>
                                                            <button type="button"  style="font-size:10px;" class="btn btn-warning rounded-pill teal">{{$trending_post[1]->category_name}}</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                    <a href="{!! url('detail/'.$trending_post[1]->post_url.'/'.Helper::base64url_encode($trending_post[1]->post_id)) !!}">
                                        <div class="card">
                                            <img src="{{url($trending_post[1]->img_path)}}" class="img-cover" height="142px" alt="">                                            <div class="caption">
                                            <h2 class="title">{{ $trending_post[1]->title }}</h2>
                                            <p class="post-meta">
                                                <span>{!! Helper::formatDate($trending_post[1]->published_date) !!}</span>
                                                <!-- <span><i class="icon-comment"></i>0</span> -->
                                                <span class="m-r-0"><i class="fa fa-eye"></i>{{$trending_post[1]->post_view_count}}</span>
                                            </p>
                                            <div class="post_category" style="text-align: right;">
                                                <ul>
                                                    <li>
                                                        <button type="button"  style="font-size:10px;" class="btn btn-warning rounded-pill">{{$trending_post[1]->category_name}}</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <a href="{!! url('detail/'.$trending_post[2]->post_url.'/'.Helper::base64url_encode($trending_post[2]->post_id)) !!}">
                                        <div class="card">
                                            <img src="{{url($trending_post[2]->img_path)}}" class="" alt=""> 
                                            <div id="copyright1">
                                                <h6 class="text-white font1">{{ $trending_post[2]->title }}</h6>
                                                <div class="row">
                                                    <div class="col-md-6 text-white">
                                                        <p class="post-meta">
                                                        <span>{!! Helper::formatDate($trending_post[2]->published_date) !!}</span>
                                                        <!-- <span><i class="icon-comment"></i>0</span> -->
                                                        <span class="m-r-0"><i class="icon-eye"></i>{{$trending_post[2]->post_view_count}}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="post_category" style="text-align: right;">
                                                            <ul>
                                                                <li>
                                                                    <button type="button" style="font-size:10px;" class="btn btn-warning rounded-pill btn1">{{$trending_post[2]->category_name}}</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                            <h6 class="text-white">{{ $trending_post[2]->title }}</h6>
                                            <div class="row">
                                                <div class="col-md-6 text-white">
                                                    <p class="post-meta">
                                                    <span>{!! Helper::formatDate($trending_post[2]->published_date) !!}</span>
                                                    <!-- <span><i class="icon-comment"></i>0</span> -->
                                                    <span class="m-r-0"><i class="fa fa-eye"></i>{{$trending_post[2]->post_view_count}}</span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="post_category">
                                                        <ul>
                                                            <li>
                                                                <button type="button" style="font-size:10px;" class="btn btn-warning rounded-pill">{{$trending_post[2]->category_name}}</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <a href="{!! url('detail/'.$trending_post[3]->post_url.'/'.Helper::base64url_encode($trending_post[3]->post_id)) !!}">
                                        <div class="card">
                                            <img src="{{url($trending_post[3]->img_path)}}" class="" alt=""> 
                                            <div id="copyright1">
                                            <h6 class="text-white font1">{{ $trending_post[3]->title }}</h6>
                                            <div class="row">
                                                <div class="col-md-6 text-white">
                                                    <p class="post-meta">
                                                        <span>{!! Helper::formatDate($trending_post[3]->published_date) !!}</span>
                                                        <!-- <span><i class="icon-comment"></i>0</span> -->
                                                        <span class="m-r-0"><i class="fa fa-eye"></i>{{$trending_post[3]->post_view_count}}</span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="post_category"  style="text-align: right;">
                                                        <ul>
                                                            <li >
                                                                <button href="button" style="font-size:10px;" class="btn btn-warning rounded-pill btn1">{{$trending_post[3]->category_name}}</button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
        <!-- </div>
    </div> -->
</section>
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


                                                <h4 class="mt-3 card_title_ellipsis"  title="{{ $post_row->title }}">{{ $post_row->title }}</h4>
                                                
                                                <p class="card_text_ellipsis" >{!! strip_tags($post_row->description) !!}</p>
                                                
                                      

                                        </a>
                                        <div class="card_footer row">
                                            <div class="col-6 text-grey">
                                                {!! Helper::formatDate($post_row->published_date) !!}
                                            </div>
                                            <div class="col-6 d-flex flex-row-reverse">
                                                <div class="post_category"  style="text-align: right;">
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