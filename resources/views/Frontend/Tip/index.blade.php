@extends('Frontend.layouts.main')
@section('main-content')


@if(count($tips) > 0)

<section class="carousel_se_01">
    <div class="container-fluid ">
            <div class="row pt-3">
                <div class="col-md-12 px-0">
                        <div class="category_header row p-2">
                            
                            <div class="col-md-3"><hr class="bg-dark"></div>
                            <div class="category_header_left col-md-3 text-center">
                            <h2>All Day Tips</h2>
                            </div>
                            <div class="col-md-3"><hr class="bg-dark"></div>
                        </div>
                        <div class="row m-0">
                            <div class="row col-md-10">
                                <!-- 1 -->
                                @foreach($tips as $row)
                                <div class="item col-md-4">
                                    <div class="col-md-12 wow fadeInUp ">
                                        <div class="main_services text-left">
                                            <a href="">
                                                <div class="img-thumbnail2 text-center">
                                                    <img src="{{url($row->img_data)}}" class="img-thumbnail2" width="100%" alt="">
                                                </div>
                                            </a>
                                            <div class="card_footer row">
                                                <div class="col-6 text-grey">
                                                    {{formatDate($row->created_at)}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="d-felx justify-content-center col-md-12">
                                    <div class="pagination">
                                        {{ $tips->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                                <!-- 1 end  -->
                            </div> <!-- owl-carousel end -->
                            
                            <div class="col-md-2 right_sidebar">
                                <!-- <div class="sidebar_top">
                                    <span>Archives</span>
                                </div>
                                <ul class="col-12">
                                    @foreach($tips as $p_row)
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
<h2 class="text-danger" >No Tip Found</h2>
@endif

@endsection