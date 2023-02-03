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
            <h6 class="page-title">Create User</h6>
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

<style>
    :root{
    --succes-color: #2ecc71;;
    --error-color: #e74c3c;
}
    .form-control input:focus{
    outline: 0;
    border-color: #777;

}

.form-control.success input {
    border-color: var(--succes-color);
}

.form-control.error input {
    border-color: var(--error-color);    
}

.form-control.success select {
    border-color: var(--succes-color);
}

.form-control.error select {
    border-color: var(--error-color);    
}
.form-control small{
    color: var(--error-color);
    position: absolute;
    bottom: 0;
    left: 0;
    visibility: hidden;
}

.form-control.error small{
    visibility: visible;
}


</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Enter User Details</h4>
                                    <form action="{{url('admin/add-user')}}" method="POST" class="outer-repeater form" id="form" >
                                        @csrf
                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Name <span class="text-danger" >* </span> :</label>
                                                    <input type="text" id="username" pattern="[A-Za-z]+{1,32}" title="Only alphabet letters" class="form-control" value="{{old('name')}}" name="name"  placeholder="Enter Name...">
                                                    @error('name')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
    
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Email <span class="text-danger" >*</span>:</label>
                                                    <input type="email" class="form-control"
                                                    title="Please enter valid email address" 
                                                    onkeyup="myFunction()"
                                                    value="{{old('email')}}" placeholder="Enter email" name="email" id="email"/>
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
                                                    <label class="form-label" for="formemail">Phone  <span class="text-danger" >*</span>:</label>
                                                    <input type="text" class="form-control" value="{{old('mobile')}}" 
                                                    placeholder="Enter phone number"
                                                    maxlength="10" pattern="[1-9]{1}[0-9]{9}"  title="Please enter valid phone number."
                                                     name="mobile" id="mobile"/>
                                                    @error('mobile')
                                                    <div class="text text-danger" id="phone1" >
                                                    {{$message}}
                                                    </div>
                                                    <script>
                                                    function myFunction() {
                                                        document.getElementById("phone1").style.display = "none";
                                                    }
                                                    </script>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="forrole">User Role <span class="text-danger" >*</span>:</label>
                                                    <select name="user_role" id="user_role" class="form-control">
                                                        <option value="" selected disabled>Select user role</option>
                                                        @foreach($roles as $row)
                                                        <option value="{{$row->role}}">{{$row->role_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('user_role')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    <!-- <script>
                                                    function myFunction() {
                                                        document.getElementById("user_role").style.display = "none";
                                                    }
                                                    </script> -->
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Password <span class="text-danger" >*</span>:</label>
                                                    <input type="password" class="form-control" name="password" id="password" />
                                                    @error('password')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
    
                                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
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
<script>

// document.getElementById("email1").addEventListener("change", myFunction);
// document.getElementById("phone1").addEventListener("change", myFunction);
// $('#email').on('input', function(){
//     // alert(gt5y6);
//     $('#email1').hide(); 
// )};

// function myFunction() {
//   var x = document.getElementById("email");
//   x.value = x.value.toUpperCase();
// }

const form = document.getElementById('form');
const username = document.getElementById('username');
const email = document.getElementById('email');
const mobile = document.getElementById('mobile');
const password = document.getElementById('password');
const user_role = document.getElementById('user_role');
//Show input error messages
function showError(input, message) {
    const formControl = input.parentElement;
    formControl.className = 'form-control error';
    const label = formControl.querySelector('label');
    label.style.color = "red";
}

//show success colour
function showSucces(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
    const label = formControl.querySelector('label');
    label.style.color = "green";

}

//check email is valid
function checkEmail(input) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(input.value.trim())) {
        showSucces(input)
    }else {
        showError(input,'Email is not invalid');
    }
}


//checkRequired fields
function checkRequired(inputArr) {
    inputArr.forEach(function(input){
        if(input.value.trim() === ''){
            showError(input)
        }else {
            showSucces(input);
        }
    });
}


//check input Length
function checkLength(input, min ,max) {
    if(input.value.length < min) {
        showError(input, `${getFieldName(input)} must be at least ${min} characters`);
    }else if(input.value.length > max) {
        showError(input, `${getFieldName(input)} must be les than ${max} characters`);
    }else {
        showSucces(input);
    }
}

//get FieldName
function getFieldName(input) {
    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

// check passwords match
function checkPasswordMatch(input1, input2) {
    if(input1.value !== input2.value) {
        showError(input2, 'Passwords do not match');
    }
}

//Event Listeners
form.addEventListener('submit',function(e) {
    e.preventDefault();
    checkRequired([username, email, password, mobile, user_role]);
    checkLength(username,3,80);
    checkEmail(email);
    if(username.value != ""  && email.value != "" && mobile.value != ""  && password.value!= ""  && user_role.value != ""){
        form.submit()
    }
});

</script>
@endsection