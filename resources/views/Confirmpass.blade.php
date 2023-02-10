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
                                pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" title="Must contain at least one number and one uppercase and 
                                lowercase letter, special character and at least 8 or more characters"
                                onkeyup="checkSpace()"
                                required>
                                @error('password')
                                <div class="text text-danger" id="formname1" >
                                    {{$message}}
                                </div>
                                @enderror
                                <br/>
                                <span class="text-danger" id="password_error" ></span>
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" onclick="showpass()"><span>Show Password</span>
                            </div>
                            <div class="border-bottom mt-4">
                                <label for="confirmpassword"><b>Confirm Password:</b></label>
                                <input type="password" class="border-0" placeholder="Enter Confirm password" name="password_confirmation"
                                    id="confirmpassword" 
                                    onkeyup="showpass1()"
                                    required>
                                @error('password_confirmation')
                                <div class="text text-danger" id="formname1" >
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mt-3 mb-2">
                                <input type="submit" name="submit" class="form-control" id="forgetbtn" onkeyup='check();'>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>

pasteNotAllowFunc('newpassword')
    function pasteNotAllowFunc(xid){
 let myInput = document.getElementById(xid);
     myInput.onpaste = (e) => e.preventDefault();
}


function showpass() {
  var x = document.getElementById("newpassword");
  if (x.type === "newpassword") {
    x.type = "text";
  } else {
    x.type = "newpassword";
  }
}

function showpass1() {
  var x = document.getElementById("confirmpassword");
  if (x.type === "confirmpassword") {
    x.type = "text";
  } else {
    x.type = "confirmpassword";
  }
}

function checkSpace(){
    var password = document.getElementById("newpassword").value;
    var password_error = document.getElementById("password_error");
    var btn = document.getElementById("forgetbtn");
    var status = hasWhiteSpace(newpassword);
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


var check = function() {
  if (document.getElementById('newpassword').value ==
    document.getElementById('confirmpassword').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}
</script>

@endsection