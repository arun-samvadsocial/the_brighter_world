@extends('Frontend.layouts.main')
@section('main-content')

<section>
    <div class="container d-flex justify-content-center mt-5">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="mt-4 p-2 text-center">
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
                                <input type="email" class="border-0" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  title="Please enter valid email address"  placeholder="Enter email" name="email" id="email"
                                    required>
                            </div>
                            <div class="border-bottom mt-4">
                                <label for="password"><b>Password:</b></label>
                                <input type="password" class="border-0" placeholder="Enter Password" name="password"
                                id="password"
                                pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" title="Must contain at least one number and one uppercase and 
                                lowercase letter, special character and at least 8 or more characters"
                                onkeyup="checkSpace()" required>
                                <br/>
                                <span class="text-danger" id="password_error" ></span>
                            </div>
                            <div class="">
                                <input type="checkbox" onclick="showpass()"><span>Show Password</span>
                            </div>
                            <div class="mt-3">
                                <input type="submit" name="submit" class="form-control" id="loginbtn">
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
<script>
    pasteNotAllowFunc('password')
    function pasteNotAllowFunc(xid){
 let myInput = document.getElementById(xid);
     myInput.onpaste = (e) => e.preventDefault();
}


function showpass() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


function checkSpace(){
    var password = document.getElementById("password").value;
    var password_error = document.getElementById("password_error");
    var btn = document.getElementById("loginbtn");
    var status = hasWhiteSpace(password);
    if(status){
        btn.disabled = true;
        password_error.innerHTML = "Space are not allowed";
    }else{
        btn.disabled = false;
        password_error.innerHTML = "";
    }
    
}
function hasWhiteSpace(s) {
  return s.indexOf(' ') >= 0;
}
</script>

@endsection