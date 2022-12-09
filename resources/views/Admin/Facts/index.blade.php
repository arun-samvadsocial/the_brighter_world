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
                        <h6 class="page-title">Facts List</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Facts</a></li>
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
                                <h4 class="card-title col-lg-9">All Facts</h4>
                                <div class="search-box text-end col-lg-3">
                                    <form action="{{url('/admin/facts-list')}}" method="get">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="search..." aria-label="">
                                            <div class="input-group-append">
                                                <input type="submit" class="input-group-text btn-primary"
                                                    value="Search" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Fact</th>
                                            <th>Status</th>
                                            <th>Published Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @php $i = $facts->perPage() * ($facts->currentPage() - 1) +1;@endphp
                                        @foreach($facts as $row)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$row->fact}}</td>
                                            <td>
                                                @if($row->fact_status ==1)
                                                <p>Approved</p>
                                                <a href="{{url('admin/change-facts-status/'.$row->fact_id)}}"
                                                    class="badge rounded-pill bg-danger">Reject</a>
                                                @else
                                                <p>Rejected</p>
                                                <a href="{{url('admin/change-facts-status/'.$row->fact_id)}}"
                                                    class="badge rounded-pill bg-success">Approve now</a>
                                                @endif
                                            </td>
                                            <td>{{$row->created_at}}</td>
                                            <td>
                                                <a href="{{url('admin/edit-facts/'.$row->fact_id)}}"
                                                    class="btn btn-primary">Edit</a>
                                                <!-- <a href="" class="btn btn-danger" >Delete</a> -->
                                            </td>
                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>
                                <div class="table_footer row">
                                    <div class="showing col-md-5">
                                        Showing {{$facts->firstItem()}} - {{$facts->lastItem()}} of {{$facts->total()}}
                                    </div>
                                    <div class="pagination col-md-7">
                                        <div class=" col-md-12 pb-2">
                                            <div class="pagination flex-wrap d-felx justify-content-center">
                                                {{ $facts->links('pagination::bootstrap-4') }}
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