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
            <h6 class="page-title">Create New Post</h6>
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



<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Enter Post Details</h4>
                                    <form action="{{url('admin/add-new-single-post')}}" method="POST" class="outer-repeater" enctype="multipart/form-data" >
                                        @csrf
                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Post Title <span class="text-danger" >*</span> :</label>
                                                    <input type="text" class="form-control" value="{{old('post_title')}}" name="post_title" id="post_title" required placeholder="Enter post title...">
                                                    @error('post_title')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                   
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Category <span class="text-danger" >*</span> :</label>
                                                    <select class=" form-control " name="category_id" style="width:100%" required   data-placeholder="Choose category ...">
                                                    <option value="" selected disabled>Select Category</option>
                                                    @foreach($category as $row)
                                                        @if(old('category_id')  == $row->category_id)
                                                        <option selected value="{{$row->category_id}}">{{$row->category_name}}</option>
                                                        @else
                                                        <option value="{{$row->category_id}}">{{$row->category_name}}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Published Date <span class="text-danger" >*</span> :</label>
                                                    <input type="datetime-local" class="form-control" value="{{old('published_date')}}" name="published_date" id="published_date" required placeholder="Enter published date...">
                                                    @error('published_date')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    
                                                    <img id="output" src="{{url('no_image.png')}}" height="150px"/>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label " for="formname">Post Image <span class="text-danger" >*</span> :</label>
                                                    <input type="file" accept="image/*" value="{{old('post_image')}}"  name="post_image" required onchange="loadFile(event)">
                                                    @error('post_image')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label " for="formname">Source of Image <span class="text-danger" >*</span> :</label>
                                                    <input type="text" class="form-control" value="{{old('img_source')}}"  name="img_source" placeholder="Enter source of image before upload" required >
                                                    @error('img_source')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Video Link (Optional):</label>
                                                    <input type="text" class="form-control"  name="video_link" value="{{old('video_link')}}"   id="video_link" placeholder="Paste your video link...">
                                                    @error('video_link')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Synopsis (Optional):</label>
                                                    <input type="text" class="form-control" name="synopsis" value="{{old('synopsis')}}"    id="synopsis" placeholder="Enter synopsis...">
                                                    @error('synopsis')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Post Description <span class="text-danger" >*</span>:</label>
                                                    <textarea name="editor1" onkeyup="SuperDuperFunction();" id="editor1" required >{{old('editor1')}}</textarea>
                                                    <script>
                                                            CKEDITOR.replace( 'editor1' );
                                                    </script>
                                                    </div>
                                                    @error('editor1')
                                                    <div class="text text-danger" id="editor2">                  
                                                    Description required.
                                                    </div>
                                                    <script>
                                                        function SuperDuperFunction() {
                                                            document.getElementById("editor2").style.display = "none";   
                                                            }
                                                    </script>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label text-dark" for="formname">Global Tags ( Don't add these Global Tags in Tags section.) :</label>
                                                    <label>tags,</label>
                                                    <br/>
                                                    <label for="">Enter Hashtags :</label>
                                                    <textarea class="form-control" rows="2" placeholder="add some #tags"  name="keywords" rows="5"  style="width:100%" id="keywords"></textarea></p>
                                                    @error('keywords')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <!-- @if(getUser()->role == 'admin' || getUser()->role == 'moderator') -->
                                                <!-- <div class="mb-3"> -->
                                                    <!-- <label class="form-label" for="formname">Do you want to notifiy readers about this article ?Yes : </label> -->
                                                    <!-- <input class="form-check-input"  name="notify"   value="1" type="checkbox" id="gridCheck1"> -->
                                                    <!-- @error('notify') -->
                                                    <!-- <div class="text text-danger" > -->
                                                    <!-- {{$message}} -->
                                                    <!-- </div> -->
                                                    <!-- @enderror -->
                                                <!-- </div> -->
                                                <!-- @endif -->

                                                

    
                                                <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection



<script>
    // $(document).ready(function(){
        
    // });
    
    /* START - preview image before upload*/
    var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
    var output = document.getElementById('output');
    localStorage.setItem('timg', reader.result);
    output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
    };
</script>
