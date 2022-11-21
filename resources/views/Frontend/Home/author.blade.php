@extends('Frontend.layouts.main')
@section('main-content')


@if(count($posts) > 0)
@php
    $cat_row = json_decode($posts[0]->category);
@endphp
<section class="carousel_se_01">
    <div class="container-fluid ">
            <div class="row pt-3">
                <div class="col-md-12 px-0">
                        <div class="category_header row p-2">
                            <div class="col-md-3"><hr class="bg-dark"></div>
                            <div class="category_header_left col-md-3 text-center">
                            <h2>{{$posts[0]->author}}</h2>
                            </div>
                            <div class="col-md-3"><hr class="bg-dark"></div>
                        </div>
                        <div class="row m-0">
                            <div class="row col-md-10">
                                <!-- 1 -->
                                @foreach($posts as $post_row)
                                <div class="item col-md-4">
                                    <div class="col-md-12 wow fadeInUp ">
                                        <div class="main_services text-left">
                                            <a href="{{ url('detail/'.$post_row->post_url.'/'.base64url_encode($post_row->post_id)) }}">
                                                <div class="img-thumbnail text-center">
                                                    <img src="{{url($post_row->img_path)}}" class="img-thumbnail" height="142px" alt="">
                                                </div>
                                                <h4 class="mt-3">{{substr_replace($post_row->title, "...", 30)}}</h4>
                                                <p>{!! substr_replace(strip_tags($post_row->description), "...", 100) !!}</p>
                                            </a>
                                            <div class="card_footer row">
                                                <div class="col-6 text-grey">
                                                    {{formatDate($post_row->published_date)}}
                                                </div>
                                                <div class="col-6 d-flex flex-row-reverse">
                                                    <div class="post_category">
                                                
                                                    {!! strtok($cat_row[0]->category_name,' ') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class=" col-md-12 pb-2">
                                    <div class="pagination d-felx justify-content-center">
                                        <a class="btn btn-light" href="{{$posts->previousPageUrl('pagination::bootstrap-4')}}">Previous</a>
                                        &nbsp;
                                        <a class="btn btn-light" href="{{$posts->nextPageUrl('pagination::bootstrap-4')}}">Next</a>
                                    </div>
                                </div>
                                <!-- 1 end  -->
                            </div> <!-- owl-carousel end -->
                            
                            <div class="col-md-2 right_sidebar">
                                <!-- <div class="sidebar_top">
                                    <span>Archives</span>
                                </div>
                                <ul class="col-12">
                                    @foreach($posts as $p_row)
                                    <li> <i><strong>- {{$p_row->created_at}}</strong></i> </li>
                                    <!-- <li>Jan</li> -->
                                    <!-- @endforeach -->
                                <!-- </ul> --> 
                            </div>
                        </div>
                </div> <!-- col-md-12 end -->
            </div> <!-- row end -->
    </div> <!-- container-fluid end -->
</section> <!-- Section end -->
@else
<h2 class="text-danger" >No Post Found</h2>
@endif

@endsection