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
            <h6 class="page-title">Edit Sub-Category</h6>
        </div>
        <div class="col-md-4">
            <div class="float-end d-none d-md-block">
                <a class="btn btn-primary" href="{{url('admin/sub-category-list')}}" >
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
                                    <h4 class="card-title">Enter Sub-Category Details</h4>
                                    <form action="{{url('admin/edit-sub-category')}}" method="POST" class="outer-repeater">
                                        @csrf
                                        <input type="text" name="id" value={{$sub_category_data->sub_category_id}} hidden >
                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                <div class="mb-3">
                                                    <label class="form-label" for="forrole">Main Category</label>
                                                    <select name="main_category" id="" class="form-control">
                                                    <option class="form-control" value="" selected disabled>Select Main Category</option>
                                                        @foreach($category as $row)
                                                        @if($row->category_id == $sub_category_data->main_category)
                                                        <option selected value="{{$row->category_id}}">{{$row->category_name}}</option>
                                                        @else 
                                                        <option value="{{$row->category_id}}">{{$row->category_name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @error('main_category')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Sub-Category Name :</label>
                                                    <input type="category_name" 
                                                    class="form-control"
                                                    value='{{$sub_category_data->sub_category_name?$sub_category_data->sub_category_name:""}}' 
                                                    name="sub_category_name" id="formname" placeholder="Enter your Sub-Category Name...">
                                                </div>
    
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Sub-Category Keywords :</label>
                                                    <input type="text"
                                                    value='{{$sub_category_data->sub_category_keywords?$sub_category_data->sub_category_keywords:""}}'
                                                     class="form-control" name="sub_category_keywords"/>
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