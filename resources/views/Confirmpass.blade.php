@extends('Frontend.layouts.main')
@section('main-content')

<section>
    <div class="container d-flex justify-content-center mt-5">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="mt-4 p-2 text-center">
                        <h2 class="text-warning"><b>Forgot Password</b>
                        </h2>
                    </div>
                     <!-- Success Message  -->
                     @if (\Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                        {!! \Session::get('success') !!}
                    </div>
                    @endif
                    <!-- Error Message  -->
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
                        {{$errors->first()}}
                    </div>
                    @endif
                    
                    <div class="card-body">
                        <form action="{{url('/confirmpass')}}" method="post">
                            @csrf
                            <input type="text" name="token"  hidden id="" value="{{ app('request')->input('token') }}">
                            <div class="border-bottom ">
                                <label for="newpassword"><b>New Password:</b></label>
                                <input type="password" class="border-0" placeholder="Enter New Password" name="password" id="newpassword"
                                    required>
                                @error('password')
                                <div class="text text-danger" id="formname1" >
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="border-bottom mt-4">
                                <label for="confirmpassword"><b>Confirm Password:</b></label>
                                <input type="password" class="border-0" placeholder="Enter Confirm password" name="password_confirmation"
                                    id="confirmpassword" required>
                                @error('password_confirmation')
                                <div class="text text-danger" id="formname1" >
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mt-3 mb-2">
                                <input type="submit" name="submit" class="form-control" id="">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection