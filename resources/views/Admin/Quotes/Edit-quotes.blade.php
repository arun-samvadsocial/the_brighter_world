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
            <h6 class="page-title">Edit Quotes</h6>
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
                                    <h4 class="card-title">Enter Quote Details</h4>
                                    <div class="row">
                                    <form action="{{url('admin/edit-quotes')}}" method="POST" class="outer-repeater col-lg-6 " enctype="mulquoteart/form-data">
                                        @csrf
                                        <input type="text" name="id" value="{{$quote_data->quote_id}}" hidden />

                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Author Name :</label>
                                                    <input type="text" class="form-control" name="quote_author" required  id="quote_author" onchange="quote_author_canvas()" value="{{$quote_data->quote_author}}" onkeyup="quote_author_canvas()" placeholder="Enter author name" />
                                                    @error('quote_author')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">quote Description :</label>
                                                    <textarea rows = '5' cols = '10' name = "quote" id="quote" required type="text" required placeholder = "Enter the quote" class = "form-control"
                                                    onkeyup="quote_canvas()">{{$quote_data->quote}}</textarea>
                                                    @error('quote')
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
                                    <!-- end form -->
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
    function wrapText(context, text, x, y, maxWidth, lineHeight){
            var cars = text.split("\n");

            for (var ii = 0; ii < cars.length; ii++) {

                var line = "";
                var words = cars[ii].split(" ");

                for (var n = 0; n < words.length; n++) {
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
                y += lineHeight;
            }
    }
    function drawImage(author,quote){
        var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d");
        canvas.width = 475;
        canvas.height = 475;
        canvas.margin = 0;
        var background = new Image();

        background.onload = function()
        {
          ctx.drawImage(background,0,0,475,475);
          ctx.font = "25px Arial";
          ctx.textAlign = 'center';
		  ctx.fillStyle = "#990000";
          wrapText(ctx, quote, 240, 100, 432, 30);
          ctx.font = "21px Italic";
          ctx.textAlign = 'right';
          var text = 'The Brighter World';
          wrapText(ctx, author, 450, 385, 400, 25);
          var data = canvas.toDataURL("image/png");
          //console.log( data);
          document.getElementById("canvas_data").value = data;

         }
      background.src= "{{url('thoughts.jpg')}}";
    }


    function quote_author_canvas(){
        var author=document.getElementById('quote_author').value;
        var quote=document.getElementById('quote').value;
        drawImage(author,quote);
		drawshareImage(author,quote);

      }

      function quote_canvas()
      {
        var quote=document.getElementById('quote').value;
        var author=document.getElementById('quote_author').value;
        drawImage(author,quote);
		drawshareImage(author,quote);

      }
	function drawshareImage(author,quote){

      var canvas = document.getElementById("canvas_share"),
      ctx = canvas.getContext("2d");

      canvas.width = 600;
      canvas.height =315;
      canvas.margin = 0;
      var background = new Image();
      background.src = "{{url('thoughts_share.jpg')}}";

      background.onload = function(){
      ctx.drawImage(background,0,0,600,315);
	    
	  ctx.font = "25px Arial";
      ctx.textAlign = 'center';
      ctx.fillStyle = "#990000";
      wrapText(ctx,quote, 302, 80, 535, 30,0,0);
	  
	  ctx.font = "21px italic";
      ctx.textAlign = 'right';
      ctx.fillStyle = "#990000";
      wrapText(ctx,author, 560, 240, 550, 25,0,0);
	  
	  
      var data = canvas.toDataURL("image/png");
      document.getElementById("share_canvas_data").value = data;
	  }
	 }


    window.onload = function () {
    var input = document.getElementById('quote');
    input.focus();
        var quote_data = "{{$quote_data->quote}}";
        var quote = `{{$quote_data->quote}}`;
        var quote_author = `{{$quote_data->quote_author}}`;
        if(quote_data != ""){
            drawImage(quote_author,quote);
            drawshareImage(quote_author,quote);
        }else{
            drawImage("","","");
            drawshareImage("","","");
        }
    }
    

</script>