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
            <h6 class="page-title">Add Fact</h6>
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
                                    <h4 class="card-title">Enter Fact Details</h4>
                                    <div class="row">
                                    <form action="{{url('admin/add-facts')}}" method="POST" class="outer-repeater col-lg-6 " enctype="mulfactart/form-data">
                                        @csrf
                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Title <spna class="text-danger" >*</span> :</label>
                                                    <input type="text" class="form-control" name="fact_title"  value="{{old('fact_title')}}" id="fact_title" onchange="title_canvas()" value="" required onkeyup="title_canvas()" placeholder="Enter Title...">
                                                    @error('fact_title')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Author Name <spna class="text-danger" >*</span> :</label>
                                                    <input type="text" class="form-control" name="fact_author"  value="{{old('fact_author')}}"  id="fact_author" onchange="fact_author_canvas()" value="" required onkeyup="fact_author_canvas()" placeholder="Enter author name" />
                                                    @error('fact_author')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Fact Description <spna class="text-danger" >*</span> :</label>
                                                    <textarea rows = '5' cols = '10' name = "fact" id="fact" type="text" placeholder = "Enter the fact" class = "form-control"
                                                    onkeyup="fact_canvas()" required>{{old('fact')}}</textarea>
                                                    @error('fact')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <textarea  rows = '5' cols = '10' id ="canvas_data" name="img_data" class = "form-control col-md-7 col-xs-12 d-none">
                                                </textarea>
                                                <textarea   rows = '5' cols = '10' id ="share_canvas_data" name="img_data_share" class = "form-control col-md-7 col-xs-12 d-none">
                                                </textarea>
                                                <img src="" id="cnv"  alt="">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- end form -->

                                    <!-- OutPut Image start -->
                                    <div class="col-lg-6 output_image" id= "canvasbox">
                                        <canvas id="canvas">
                                        </canvas>
                                    </div>
                                    <div >
                                        <canvas class="col-lg-6 output_image" id="canvas_share">
                                        </canvas>
                                        <br>
                                    </div>
                                    <!-- Output Image end  -->
                                    </div>
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
    function wrapText(context, text, x, y, maxWidth, lineHeight,flag) {
            var cars = text.split("\n");
            var bullet=[];
            for (var ii = 0; ii < cars.length; ii++)
            {
              bullet[ii]=y;
                var line = "";
                var words = cars[ii].split(" ");

                for (var n = 0; n < words.length; n++)
                {
                    var testLine = line + words[n] + " ";
                    var metrics = context.measureText(testLine);
                    var testWidth = metrics.width;

                    if (testWidth > maxWidth) {
                        context.fillText(line, x, y);
                        line = words[n] + " ";
                        y += lineHeight;
                    }
                    else {
                        line = testLine;
                    }
                }
                  context.fillText(line, x, y);
                if(flag==1)
                {

                context.beginPath();

                context.arc(12, bullet[ii], 3, 0, 2 * Math.PI);
                context.fillStyle="white";
                context.fill();
                  y += 7;
              }

                y += lineHeight;


            }
    }
    function drawImage(title,author,fact)
    {
        var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d");
        canvas.width = 475;
        canvas.height = 475;
        canvas.margin = 0;
        var background = new Image();
        background.onload = function()
        {
          ctx.drawImage(background,0,0);
          ctx.font = "25px Calibri";
          ctx.textAlign = 'center';
          ctx.textBaseline='middle';
          ctx.fillStyle = "white";
          wrapText(ctx, title, 238, 80, 460, 25,0);
		  
		  ctx.font = "17px Calibri";
          ctx.textAlign = 'right';
          ctx.textBaseline='middle';
          wrapText(ctx, author, 440, 440, 450, 20,0);


          ctx.font = "21px Calibri";
          ctx.textAlign = 'left';
          ctx.textBaseline='middle';
          wrapText(ctx, fact, 22, 180, 450, 20,1);
          var data = canvas.toDataURL("image/png");

          document.getElementById("canvas_data").value = data;

         }

      background.src= "{{url('factbackground.jpg')}}";
    }

      function title_canvas()
      {
		   var author=document.getElementById('fact_author').value;
        var title=document.getElementById('fact_title').value;
        var fact=document.getElementById('fact').value;

        drawImage(title,author,fact);


      }
	    function fact_author_canvas()
      {
        var title=document.getElementById('fact_title').value;
        var author=document.getElementById('fact_author').value;
        var fact=document.getElementById('fact').value;

        drawImage(title,author,fact);


      }
      function fact_canvas()
      {
		    var author=document.getElementById('fact_author').value;
        var fact=document.getElementById('fact').value;
        var title=document.getElementById('fact_title').value;

        drawImage(title,author,fact);
      }

    window.onload = function () {
    var input = document.getElementById('fact_title');
    input.focus();
    drawImage("","","");
    drawshareImage("","","");
    }
    

</script>