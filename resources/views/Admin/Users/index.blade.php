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
                        <h6 class="page-title">Users List</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Users</a></li>
                            <li class="breadcrumb-item"><a href="#"></a></li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <a class="btn btn-primary" href="javascript:history.back()">
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

                            <div class="row">
                                <h4 class="card-title col-lg-9">All Users</h4>
                                <div class="search-box text-end col-lg-3">
                                    <form action="{{url('/admin/user-list')}}" method="get">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="search..." aria-label="" style="border-color: #4e58aa;">
                                            <div class="input-group-append">
                                                <input type="submit" class="input-group-text btn-primary"
                                                    value="Search" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Role</th>
                                            <th>Register Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @php $i = $users->perPage() * ($users->currentPage() - 1) +1;@endphp
                                        @foreach($users as $row)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->mobile}}</td>
                                            <td>{{$row->role_name}}</td>
                                            <td>{{date('d/m/Y h:i:s a', strtotime($row->created_at));}}</td>
                                            <td>
                                                @if($row->id == auth()->user()->id)
                                                @if($row->status ==1)
                                                    <a href="#"
                                                        class="badge rounded-pill bg-success">Active</a>
                                                    @else
                                                    <a href="#"
                                                        class="badge rounded-pill bg-danger">Deactivated</a>
                                                    @endif
                                                @else
                                                @if($row->status ==1)
                                                    <a href="{{url('admin/change-user-status/'.$row->id)}}"
                                                        class="badge rounded-pill bg-success">Active</a>
                                                    @else
                                                    <a href="{{url('admin/change-user-status/'.$row->id)}}"
                                                        class="badge rounded-pill bg-danger">Deactivated</a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url('admin/edit-user/'.$row->id)}}"
                                                    class="btn btn-primary">Edit</a>
                                                <!-- <a href="" class="btn btn-danger" >Delete</a> -->
                                            </td>
                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>
                                <div class="table_footer row">
                                    <div class="showing col-md-5">
                                        Showing {{$users->firstItem()}} - {{$users->lastItem()}} of {{$users->total()}}
                                    </div>
                                    <div class="pagination col-md-7">
                                        <div class=" col-md-12 pb-2">

                                            <div class="pagination flex-wrap d-felx justify-content-center">
                                                {{ $users->links('pagination::bootstrap-4') }}
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