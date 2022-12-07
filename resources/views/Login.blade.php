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
                    <!-- Error Message  -->
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
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
                            <div class="mt-2">
                                <!-- <a href="" class="text-primary1 float-right">Forgot Password</a> -->
                            </div>
                            <div class="mt-5">
                                <input type="submit" name="submit" class="form-control" id="">
                            </div>
                            <div class="mt-4">
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