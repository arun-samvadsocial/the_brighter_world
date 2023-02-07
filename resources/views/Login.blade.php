@extends('Frontend.layouts.main')
@section('main-content')

<section>
    <div class="container d-flex justify-content-center mt-5">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="mt-4 p-2">
                        <h2 class="text-warning"><b>Sign In</b>
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
                        <form action="{{url('/login')}}" method="post">
                            @csrf
                            <div class="border-bottom ">
                                <label for="email"><b>Email:</b></label>
                                <input type="email" class="border-0" placeholder="Enter email" name="email" id="email"
                                    required>
                            </div>
                            <div class="border-bottom mt-4">
                                <label for="email"><b>Password:</b></label>
                                <input type="password" class="border-0" placeholder="Enter Password" name="password"
                                    id="password" required>
                            </div>
                            <div class="mt-3">
                                <input type="submit" name="submit" class="form-control" id="">
                            </div>
                                <a href="{{url('/forget')}}" class="text-primary1 float-right">Forgot Password?</a>
                            <div class="mt-5">
                            <p class="text-center">New User?<a href="{{url('/register')}}" class="text-primary1">Sign up now</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection