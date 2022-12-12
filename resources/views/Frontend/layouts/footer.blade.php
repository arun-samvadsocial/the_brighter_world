<!-- Footer -->
<footer class="page-footer font-small ">

    <!-- Footer Links -->
    <div class="container-fluid text-center stext-md-left collapse footer navbar-fixed-bottom  pt-4"
        aria-expanded="false" id="collapseExample2" style="border-top:1px solid #ffc107" >

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-lg-4 mt-md-0 mt-3">

                <!-- Content -->
                <img src="{{url('logo.svg')}}" alt="" style="width:50%">
                <p></p>

            </div>
            <!-- Grid column -->

            <!-- <hr class="clearfix w-100 d-md-none pb-3"> -->

            <!-- Grid column -->
            <div class="col-lg-4 mb-md-0 mb-3">

                <!-- Links -->
                <h5 class="text-uppercase">Categories</h5>

                <ul class="list-unstyled">
                    @php $category = Helper::getCategory(5);


                    @endphp

                    @foreach($category as $row)
                    @if(count(Helper::getPosts($row->category_id,'')) > 0 )
                    <li>
                        <a
                            href="{!! url('/').'/category/'.$row->category_name.'/'.Helper::base64url_encode($row->category_id) !!}">{{$row->category_name}}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-lg-4 mb-md-0 mb-3">

                <!-- Links -->
                <h5 class="text-uppercase">Links</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{url('/about-us')}}">About us</a>
                    </li>
                </ul>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center bg-warning">
        <div class="row pt-0 ">
            <!-- Content -->
            <div class="col-lg-3 col-sm-12 pt-2 footer-logo">
                <!-- <img src="{{url('logo-white.svg')}}" class="col-lg-3 col-sm-12 ml-5 footer-logo" width="10px" alt=""> -->
            <!-- <p><strong>The Brighter Wrold</strong></p> -->
            </div>
            <div class="cp col-lg-6 col-sm-12 pt-2">
                © <script>
                document.write(new Date().getFullYear())
                </script> The Brighter World <span class="d-none d-sm-inline-block"></span>
            </div>
            <div class="col-lg-3" style="text-align: end;">
                <i class="fa fa-arrow-circle-o-up" style="margin-top: 3%;font-size: 2em; cursor: pointer;padding-right: 5px;" data-toggle="collapse" href="#collapseExample2"
        aria-expanded="false" aria-controls="collapseExample2" ></i>
            </div>

        </div>


    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script src="{{url('/Frontend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{url('/Frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('/Frontend/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
<script src="{{url('/Frontend/js/carausol_slider.js')}}"></script>

</body>

</html>