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
                    <!-- Error Message  -->
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="border-bottom ">
                                <label for="email"><b>Email:</b></label>
                                <input type="email" class="border-0" placeholder="Enter email" name="email" id="email"
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