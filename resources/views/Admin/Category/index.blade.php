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
                                    <h6 class="page-title">Category List</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Categories</a></li>
                                        <li class="breadcrumb-item"><a href="#"></a></li>
                                    </ol>
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
                        <!-- end page title -->
                        @if (\Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    {!! \Session::get('success') !!}
                            </div>
                        @endif
                        <!-- Error Message  -->
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{$errors->first()}}
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">All Categories</h4>
                                       
                                        <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Category Name</th>
                                                    <th>Category Keywords</th>
                                                    <th>Sort Order</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                            @php $i = $category->perPage() * ($category->currentPage() - 1) +1;@endphp
                                            @foreach($category as $row)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$row->category_name}}</td>
                                                    <td>{{$row->category_keywords}}</td>
                                                    <td>{{$row->short_order_status}}</td>
                                                    <td>
                                                        @if($row->category_status ==1)
                                                        <a href="{{url('admin/change-category-status/'.$row->category_id)}}" class="badge rounded-pill bg-success">Active</a>
                                                        @else
                                                        <a href="{{url('admin/change-category-status/'.$row->category_id)}}" class="badge rounded-pill bg-danger">Deactivated</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{url('admin/edit-category/'.$row->category_id)}}" class="btn btn-primary" >Edit</a>
                                                        <!-- <a href="" class="btn btn-danger" >Delete</a> -->
                                                    </td>
                                                </tr>
                                                
                                            @endforeach
                                            
                                            </tbody>
                                           
                                        </table>
                                                <div class="table_footer row">
                                                    <div class="showing col-md-6">
                                                        Showing {{$category->firstItem()}} - {{$category->lastItem()}} of {{$category->total()}}
                                                    </div>
                                                    <div class="pagination col-md-6">
                                                        <div class=" col-md-12 pb-2">
                                                            <div class="pagination flex-wrap d-felx justify-content-center">
                                                                {{ $category->links('pagination::bootstrap-4') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                       

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                  
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
            </div>
            <!-- end main content-->


@endsection