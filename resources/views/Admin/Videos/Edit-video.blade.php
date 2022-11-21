@extends('Admin.layouts.main')
@section('main-content')
<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

<!-- start page title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h6 class="page-title">Edit Video</h6>
        </div>
        <div class="col-md-4">
            <div class="float-end d-none d-md-block">
                <a class="btn btn-primary" href="{{url('admin/videos')}}" >
                    Back
                 </a>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->



<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Enter Buy Button Details</h4>
                                    <form action="{{url('admin/edit-video')}}" method="POST" class="outer-repeater">
                                        @csrf
                                        <input type="text" name="id" value={{$video_data->id}} hidden >
                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Video Title :</label>
                                                    <input type="text" class="form-control" name="video_title"
                                                    value="{{$video_data->name?$video_data->name:''}}"
                                                    />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Video URL :</label>
                                                    <textarea rows="10" class="form-control" name="video_url" >{{$video_data->video_url?$video_data->video_url:''}}</textarea>
                                                    
                                                </div>
                                                
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- end form -->
                                </div>
                                <!-- end cardbody -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
               
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->




                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
            </div>
            <!-- end main content-->
@endsection