<!-- Footer -->
<footer class="page-footer font-small footer-color pt-4">

    <!-- Footer Links -->
    <div class="container-fluid text-center stext-md-left">

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-3 mt-md-0 mt-3">

                <!-- Content -->
                <img src="{{url('logo.png')}}" alt="">
                <p></p>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none pb-3">

            <!-- Grid column -->
            <div class="col-md-3 mb-md-0 mb-3">

                <!-- Links -->
                <h5 class="text-uppercase">Category</h5>

                <ul class="list-unstyled">
                    @php $category = Helper::getCategory(5);
                    
                    
                    @endphp

                    @foreach($category as $row)
                    @if(count(Helper::getPosts($row->category_id,'')) > 0 )
                    <li>
                        <a href="{!! url('/').'/category/'.$row->category_name.'/'.Helper::base64url_encode($row->category_id) !!}">{{$row->category_name}}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 mb-md-0 mb-3">

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
    <div class="footer-copyright footer-color text-center py-3">
        © <script>
        document.write(new Date().getFullYear())
        </script> The Brighter World <span class="d-none d-sm-inline-block"></span>

    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->

<script>window.user_token = 'Mpihxlxmx2oN';var scriptTag  = document.createElement('script');scriptTag.type = 'text/javascript';scriptTag.src = 'https://myfreescorenow.com/js/credit_snapshot/test.js';var s= document.getElementsByTagName('script')[0];s.parentNode.insertBefore(scriptTag,s);</script>

<script src="{{url('/Frontend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{url('/Frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('/Frontend/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
<script src="{{url('/Frontend/js/carausol_slider.js')}}"></script>
</body>

</html>