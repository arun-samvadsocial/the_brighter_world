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
                                    <h6 class="page-title">Author Profiles</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Authors</a></li>
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
                        @if (\Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">All Active Users</h4>
                                        <!-- <p class="card-title-desc">The Buttons extension for DataTables
                                            provides a common set of options, API methods and styling to display
                                            buttons on a page that will interact with a DataTable. The core library
                                            provides the based framework upon which plug-ins can built.
                                        </p> -->
                                       
                                        <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                            @php $i = 1;@endphp
                                            @foreach($users as $row)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$row->name}}</td>
                                                    <td>{{$row->username}}</td>
                                                    <td>{{$row->email}}</td>
                                                    <td>{{$row->mobile}}</td>
                                                    <td>{{$row->role}}</td>
                                                    <td>
                                                        @if($row->status ==1)
                                                        <span class="badge rounded-pill bg-success">Active</span>
                                                        @else
                                                        <span class="badge rounded-pill bg-danger">Deactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="" class="btn btn-primary" >Edit</a>
                                                        <a href="" class="btn btn-danger" >Delete</a>
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