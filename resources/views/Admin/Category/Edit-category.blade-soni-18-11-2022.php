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
            <h6 class="page-title">Edit Category</h6>
        </div>
        <div class="col-md-4">
            <div class="float-end d-none d-md-block">
                <a class="btn btn-primary" href="javascript:history.back()" >
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
                                    <h4 class="card-title">Enter Category Details</h4>
                                    <form action="{{url('admin/edit-category')}}" method="POST" class="outer-repeater">
                                        @csrf
                                        <input type="text" name="id" value={{$category_data->category_id}} hidden >
                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Category Name <spna class="text-danger" >*</span> :</label>
                                                    <input type="category_name" 
                                                    required
                                                    class="form-control"
                                                    value='{{$category_data->category_name?$category_data->category_name:""}}' 
                                                    name="category_name" id="formname" placeholder="Enter your Name...">
                                                    @error('category_name')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
    
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Category Keywords <spna class="text-danger" >*</span> :</label>
                                                    <input type="text"
                                                    required
                                                    value='{{$category_data->category_keywords?$category_data->category_keywords:""}}'
                                                     class="form-control" name="category_keywords"/>
                                                     @error('category_keywords')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                    </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Sort Order <spna class="text-danger" >*</span> :</label>
                                                    <input type="text"
                                                    required
                                                    value='{{$category_data->short_order_status?$category_data->short_order_status:""}}'
                                                     class="form-control" name="short_order_status"/>
                                                     @error('short_order_status')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
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