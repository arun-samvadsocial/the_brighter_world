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
            <h6 class="page-title">Edit User</h6>
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
                                   
                                    <form action="{{url('admin/edit-user')}}" method="POST" class="outer-repeater">
                                        @csrf
                                        <input type="text" name="id" value={{$user_data->id}} hidden >
                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Name <spna class="text-danger" >*</span> :</label>
                                                    <input type="text" 
                                                    class="form-control"
                                                    value='{{$user_data->name?$user_data->name:""}}'
                                                    name="name" id="formname" pattern="[A-Za-z]+{1,32}" placeholder="Enter your Name..." required>
                                                    @error('name')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
    
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Email <spna class="text-danger" >*</span>:</label>
                                                    <input type="email"  onInput="myFunction()" required
                                                    value={{$user_data->email?$user_data->email:""}} 
                                                     class="form-control" name="email" disabled id="email"/>
                                                     @error('email')
                                                    <div class="text text-danger" id="email1" >
                                                    {{$message}}
                                                    </div>
                                                    <script>
                                                    function myFunction() {
                                                        document.getElementById("email1").style.display = "none";
                                                    }
                                                    </script>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Phone <spna class="text-danger" >*</span>:</label>
                                                    <input type="number"  maxlength="10" pattern="[1-9]{1}[0-9]{9}" onInput="myFunction1()" required
                                                    class="form-control" disabled
                                                    value={{$user_data->mobile?$user_data->mobile:""}}  
                                                    name="mobile" id="mobile"/>
                                                    @error('mobile')
                                                    <div class="text text-danger" id="phone1" >
                                                    {{$message}}
                                                    </div>
                                                    <script>
                                                    function myFunction1() {
                                                        document.getElementById("phone1").style.display = "none";
                                                    }
                                                    </script>
                                                    @enderror
                                                </div>
                                                @if(Helper::getUser()->email != $user_data->email)
                                                <div class="mb-3">
                                                    <label class="form-label" for="forrole">User Role <spna class="text-danger" >*</span>:</label>
                                                    <select name="user_role" id="" class="form-control" required>
                                                        <option value="" selected disabled>Select user role </option>
                                                        @foreach($roles as $row)
                                                        @if($row->role == $user_data->role)
                                                        <option selected value="{{$row->role}}">{{$row->role_name}}</option>
                                                        @else 
                                                        <option value="{{$row->role}}">{{$row->role_name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @error('user_role')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                @endif
                                                
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