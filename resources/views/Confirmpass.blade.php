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
                    <!-- Error Message  -->
                    
                    <div class="card-body">
                        <form action="" method="post">
                            
                            <div class="border-bottom ">
                                <label for="newpassword"><b>New Password:</b></label>
                                <input type="newpassword" class="border-0" placeholder="Enter New Password" name="newpassword" id="newpassword"
                                    required>
                            </div>
                            <div class="border-bottom mt-4">
                                <label for="confirmpassword"><b>Confirm Password:</b></label>
                                <input type="confirmpassword" class="border-0" placeholder="Enter Confirm password" name="confirmpassword"
                                    id="confirmpassword" required>
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