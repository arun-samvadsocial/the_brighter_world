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
            <h6 class="page-title">Edit Post</h6>
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
                                    <form action="{{url('admin/edit-post')}}" method="POST" class="outer-repeater" enctype="multipart/form-data" >
                                        @csrf
                                        <input type="text" name="id" value={{$post_data->post_id}} hidden >

                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Post Title <span class="text-danger" >*</span> :</label>
                                                    <input type="text" class="form-control" required name="post_title" value="{{$post_data->title}}"  id="post_title" placeholder="Enter post title...">
                                                    @error('post_title')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                @if(auth()->user()->role == 'admin' || auth()->user()->role ==
                                                'moderator')
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Published By <span class="text-danger" >*</span> :</label>
                                                    <select class=" form-control " name="published_by" style="width:100%" required  data-placeholder="Choose Publisher ...">
                                                    @foreach(Helper::getAuthor() as $row)

                                                        @if($post_data->user_id == $row->id)
                                                        <option selected value="{{$row->id}}">{{$row->name}}</option>
                                                        @else
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>
                                                @endif
    
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Category <span class="text-danger" >*</span> :</label>
                                                    <select class=" form-control " name="category_id" style="width:100%" required  data-placeholder="Choose category ...">
                                                    @foreach($category as $row)

                                                        @if($post_data->category_id == $row->category_id)
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
                                                    <label class="form-label" for="formname">Published Date <span class="text-danger" >*</span> : {{$post_data->published_date}} </label>
                                                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'moderator')
                                                    <input type="datetime-local" name="published_date"  class="form-control" value="{{$post_data->published_date}}" id="">
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <img id="output" src="{{ url($post_data->img_path) }}" height="150px"/>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label " for="formname">Post Image <span class="text-danger" >*</span> :</label>
                                                    <input type="file" accept="image/*" name="post_image" onchange="loadFile(event)">
                                                    @error('post_image')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label " for="formname">Source of Image <span class="text-danger" >*</span> :</label>
                                                    <input type="text" class="form-control" value="{{$post_data->img_source}}"  placeholder="Enter source of image before upload" name="img_source" required >
                                                    @error('img_source')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Video Link (Optional):</label>
                                                    <input type="text" class="form-control" name="video_link" value="{{$post_data->video_link}}"   id="video_link" placeholder="Paste your video link...">
                                                    @error('video_link')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Synopsis (Optional):</label>
                                                    <input type="text" class="form-control" name="synopsis" value="{{$post_data->synopsis}}"    id="synopsis" placeholder="Enter synopsis...">
                                                    @error('synopsis')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Post Description <span class="text-danger" >*</span>:</label>
                                                    <grammarly-editor-plugin>
                                                        <textarea name="editor1" required >{{$post_data->description}}</textarea>
                                                    </grammarly-editor-plugin>
                                                    <script>
                                                            CKEDITOR.replace( 'editor1' );
                                                    </script>
                                                    </div>
                                                    @error('editor1')
                                                    <div class="text text-danger" >
                                                    Description required.
                                                    </div>
                                                    @enderror
                                                </div>

                                                

                                                <div class="mb-3">
                                                    <!-- <label class="form-label text-dark" for="formname">Global Tags ( Don't add these Global Tags in Tags section.) :</label>
                                                    <label>tags,</label> -->
                                                    <br/>
                                                    <label for="">Enter Hashtags :</label>
                                                    
                                                    <textarea class="form-control" name="keywords" rows="2" placeholder="add some #tags"   style="width:100%" id="keywords">{{$post_data->hashtags}}</textarea></p>
                                                    
                                                    @error('keywords')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                

                                                

    
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
    /* START - preview image before upload*/
    var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
    var output = document.getElementById('output');
    output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
    };
</script>
