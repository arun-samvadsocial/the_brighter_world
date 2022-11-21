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
                                    <h6 class="page-title">Buy Buttons List</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Buy Buttons</a></li>
                                        <li class="breadcrumb-item"><a href="#"></a></li>
                                    </ol>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-end d-none d-md-block">
                                        <div class="dropdown">
                                            <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                 Back
                                            </button>
                                            
                                        </div>
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

                                        <h4 class="card-title">All Buy Buttons</h4>
                                       
                                        <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Buy Button</th>
                                                    <th>User Email</th>
                                                    <th>Publish Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                            @php $i = 1;@endphp
                                            @foreach($buy_buttons as $row)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$row->buy_button_code}}</td>
                                                    <td>{{$row->email}}</td>
                                                    <td>{{$row->publish_date}}</td>
                                                    <td>
                                                        @if($row->status ==1)
                                                        <a href="{{url('admin/change-buy-button-status/'.$row->id)}}" class="badge rounded-pill bg-success">Active</a>
                                                        @else
                                                        <a href="{{url('admin/change-buy-button-status/'.$row->id)}}" class="badge rounded-pill bg-danger">Deactivated</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{url('admin/edit-buy-button/'.$row->id)}}" class="btn btn-primary" >Edit</a>
                                                        <!-- <a href="" class="btn btn-danger" >Delete</a> -->
                                                    </td>
                                                </tr>
                                                
                                            @endforeach
                                            
                                            </tbody>
                                           
                                        </table>
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