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
            <h6 class="page-title">Create User</h6>
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
                                    <h4 class="card-title">Enter User Details</h4>
                                    <form action="{{url('admin/add-user')}}" method="POST" class="outer-repeater">
                                        @csrf
                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Name <span class="text-danger" >*</span> :</label>
                                                    <input type="text" pattern="[A-Za-z]{1,32}" title="Only alphabet letters" class="form-control" value="{{old('name')}}" name="name" id="formname" required placeholder="Enter Name...">
                                                    @error('name')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
    
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Email <span class="text-danger" >*</span>:</label>
                                                    <input type="email" class="form-control"
                                                    title="Please enter valid email address" 
                                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                    value="{{old('email')}}" placeholder="Enter email" required name="email" id="email"/>
                                                    @error('email')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Phone  <span class="text-danger" >*</span>:</label>
                                                    <input type="text" class="form-control" value="{{old('mobile')}}" 
                                                    placeholder="Enter phone number"
                                                    pattern="[6789][0-9]{9}" title="Please enter valid phone number."
                                                    required name="mobile" id="mobile"/>
                                                    @error('mobile')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="forrole">User Role <span class="text-danger" >*</span>:</label>
                                                    <select name="user_role" id="" class="form-control" required>
                                                        <option value="" selected disabled>Select user role</option>
                                                        @foreach($roles as $row)
                                                        <option value="{{$row->role}}">{{$row->role_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('user_role')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Password <span class="text-danger" >*</span>:</label>
                                                    <input type="password" class="form-control" name="password" id="password" required/>
                                                    @error('password')
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