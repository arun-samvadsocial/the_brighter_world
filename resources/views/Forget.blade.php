@extends('Frontend.layouts.main')
@section('main-content')

<section>
    <div class="container d-flex justify-content-center mt-5">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="mt-4 text-center">
                        <h2 class="text-warning"><b>Reset Password</b>
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
                        <form action="{{url('/forget')}}" method="post">
                            @csrf
                            <div class="border-bottom ">
                                <label for="email"><b>Email:</b></label>
                                <input type="email" class="border-0" placeholder="Enter email" name="email" id="email"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  title="Please enter valid email address" 
                                    required>
                            </div>
                            <div class="mt-3">
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