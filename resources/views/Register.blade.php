@extends('Frontend.layouts.main')
@section('main-content')

<section>
    <div class="container d-flex justify-content-center mt-5">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="mt-4 p-2">
                        <h2 class="text-warning"><b>Sign Up</b>
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
                        <form action="{{url('/register')}}" method="post">
                            @csrf
                            <div class="border-bottom ">
                                <label for="email"><b>Name:</b></label>
                                <input type="name" class="border-0" placeholder="Enter name" value="{{old('name')}}" name="name" id="name"
                                    required>
                                
                            </div>
                            <div class="border-bottom ">
                                <label for="email"><b>Email:</b></label>
                                <input type="email" class="border-0" placeholder="Enter email" value="{{old('email')}}" name="email" id="email"
                                    required>
                               
                            </div>
                            <div class="border-bottom ">
                                <label for="mobile"><b>Mobile:</b></label>
                                <input type="text" class="border-0" placeholder="Enter mobile" value="{{old('mobile')}}" name="mobile" id="email"
                                    required>
                               
                            </div>
                            <div class="border-bottom mt-4">
                                <label for="email"><b>Password:</b></label>
                                <input type="password" class="border-0" placeholder="Enter Password" name="password"
                                    id="password" required>
                            </div>
                            <!-- Google reCaptcha v2 -->
                            {!! htmlFormSnippet() !!}
                            @if($errors->has('g-recaptcha-response'))
                            <div>
                                <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                            </div>
                            @endif
                            <div class="mt-2">
                                <!-- <a href="" class="text-primary1 float-right">Forgot Password</a> -->
                            </div>
                            <div class="mt-5">
                                <input type="submit" name="submit" class="form-control" id="">
                            </div>
                            <div class="mt-4">
                                <p class="text-center">Already registered?<a href="{{url('/login')}}" class="text-primary1">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection