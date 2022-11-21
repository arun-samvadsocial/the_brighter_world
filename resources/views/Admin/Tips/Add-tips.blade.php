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
            <h6 class="page-title">Add Tip</h6>
        </div>
        <div class="col-md-4">
            <div class="float-end d-none d-md-block">
                <a class="btn btn-primary" href="{{url('admin/tips-list')}}" >
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
                                    <h4 class="card-title">Enter Tip Details</h4>
                                    <div class="row">
                                    <form action="{{url('admin/add-tips')}}" method="POST" class="outer-repeater col-lg-6 " enctype="multipart/form-data">
                                        @csrf
                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formname">Title :</label>
                                                    <input type="text" class="form-control" name="tip_title" id="tip_title" onchange="title_canvas()" value="" onkeyup="title_canvas()" placeholder="Enter Title...">
                                                    @error('tip_title')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Author Name :</label>
                                                    <input type="text" class="form-control" name="tip_author"  id="tip_author" onchange="tip_author_canvas()" value="" onkeyup="tip_author_canvas()" placeholder="Enter author name" />
                                                    @error('tip_author')
                                                    <div class="text text-danger" >
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="formemail">Tip Description :</label>
                                                    <textarea rows = '5' cols = '10' name = "tip" id="tip" type="text" placeholder = "Enter the tip" class = "form-control"
                                                    onkeyup="tip_canvas()">&nbsp;</textarea>
                                                    @error('tip')
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
    function wrapText(context, text, x, y, maxWidth, lineHeight,flag,bulletx) {
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
                    if(y>=340 && x<=testWidth)
                    {
                      maxWidth=300;
                    }
                    if (testWidth > maxWidth)
                    {
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

                context.arc(bulletx, bullet[ii], 3, 0, 2 * Math.PI);
                context.fillStyle="black";
                context.fill();
                  y += 7;
              }

                y += lineHeight;


            }
    }


    
    function drawImage(title,author,tip){
        var canvas = document.getElementById("canvas"),
        ctx = canvas.getContext("2d");
        canvas.width = 475;
        canvas.height = 475;
        canvas.margin = 0;
        var background = new Image();
        //console.log(title);
        background.onload = function()
        {
            ctx.drawImage(background,0,0);
          ctx.font = "25px Calibri";
          ctx.textAlign = 'center';
          ctx.textBaseline='middle';
          ctx.fillStyle = "#fcc80d"; 
          wrapText(ctx, title, 280, 80, 440, 25,0,0);

          ctx.font = "600 21px Calibri";
          ctx.textAlign = 'left';
          ctx.textBaseline='middle';
          ctx.fillStyle = "black";
          ctx.strokeStyle="transparent";
          ctx.rect(335, 350, 110, 100);
          ctx.stroke();
          wrapText(ctx, author, 36, 440, 425, 20,0,0);

          ctx.font = "400 18px Verdana";
          ctx.textAlign = 'left';
          ctx.textBaseline='middle';
          ctx.fillStyle = "black";

          ctx.strokeStyle="transparent";
          ctx.rect(335, 350, 110, 100);
          ctx.stroke();
          wrapText(ctx, tip, 36, 180, 425, 20,1,30);


          var data = canvas.toDataURL("image/png");
          //console.log( data);

          document.getElementById("canvas_data").value = data;
          
         }

      background.src= "{{url('tipbackground.jpg')}}";

    }


    function title_canvas(){
        var title=document.getElementById('tip_title').value;
        var author=document.getElementById('tip_author').value;
        var tip=document.getElementById('tip').value;

        drawImage(title,author,tip);
         drawshareImage(title,author,tip);

    }
    function tip_author_canvas(){
        var title=document.getElementById('tip_title').value;
        var author=document.getElementById('tip_author').value;
        var tip=document.getElementById('tip').value;

        drawImage(title,author,tip);
        drawshareImage(title,author,tip);
    }
    function tip_canvas(){
        var title=document.getElementById('tip_title').value;
        var author=document.getElementById('tip_author').value;
        var tip=document.getElementById('tip').value;

        drawImage(title,author,tip);
        drawshareImage(title,author,tip);
    }

    function drawshareImage(title,author,tip){

      var canvas = document.getElementById("canvas_share"),
      ctx = canvas.getContext("2d");

      canvas.width = 600;
      canvas.height =315;
      canvas.margin = 0;
      var background = new Image();
      background.src = "{{ url('Tipshare.jpg')}}";

      background.onload = function(){
        ctx.drawImage(background,0,0,600,315);
      ctx.font = "500 18px Verdana";
      ctx.textAlign = 'center';
      ctx.textBaseline='middle';
      ctx.fillStyle = "black";
      wrapText(ctx, title, 320, 50, 380, 20,0,0);

      ctx.font = "italic 14px Verdana";
      ctx.textAlign = 'right';
      ctx.textBaseline='middle';
      ctx.fillStyle = "black";
      ctx.strokeStyle="transparent";
      ctx.rect(335, 350, 110, 100);
      ctx.stroke();
      wrapText(ctx, author, 580, 290, 425, 20,0,0);

      ctx.font = "500 17px Verdana";
      ctx.textAlign = 'left';
      ctx.textBaseline='middle';
      ctx.fillStyle = "black";

      ctx.strokeStyle="transparent";
      ctx.rect(335, 350, 110, 100);
      ctx.stroke();
      wrapText(ctx, tip, 170, 80, 420, 20,1,160);

      var data = canvas.toDataURL("image/png");
      document.getElementById("share_canvas_data").value = data;

     }
    }

    window.onload = function () {
    var input = document.getElementById('tip_title');
    input.focus();
    drawImage("","","");
    drawshareImage("","","");
    }
    

</script>