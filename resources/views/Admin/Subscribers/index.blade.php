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
                                    <h6 class="page-title">Email Subscribers List</h6>
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="#">Email Subscribers</a></li>
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

                                        <h4 class="card-title">All Email Subscribers</h4>
                                       
                                        <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Subscriber Email</th>
                                                    <th>Subscribe Date</th>
                                                    <th>Unsubscribe Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                            @php $i = 1;@endphp
                                            @foreach($subscriber_data as $row)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$row->subscriber_email}}</td>
                                                    <td>{{date('d/m/Y h:i:s a', strtotime($row->subscription_date));}}</td>
                                                    <td>{{date('d/m/Y h:i:s a', strtotime($row->unsubscribe_date));}}</td>
                                                    <td>
                                                        @if($row->status ==1)
                                                        <p>Subscribed</p>
                                                        <a href="{{url('admin/change-subscriber-status/'.$row->id)}}" class="badge rounded-pill bg-danger">Unsubscribe now !</a>
                                                        @else
                                                        <p>Unsubscribed</p>
                                                        <a href="{{url('admin/change-subscriber-status/'.$row->id)}}" class="badge rounded-pill bg-success">Subscribe now!</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{url('admin/edit-subscribers/'.$row->id)}}" class="btn btn-primary" >Edit</a>
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