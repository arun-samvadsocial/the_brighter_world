<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta_data')
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('favicon.png')}}">
    <!-- Vendor CSS Files -->
    <link href="{{url('/Frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <link href="{{url('/Frontend/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{url('/Frontend/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

   <link href="{{url('/Frontend/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" type="text/css" href="{{url('/Frontend/css/style.css')}}">
     
    
    <title>The Brighter World</title>

  </head>
<body>
    <header>
        <div class="header_top">
            <div class="row" style="margin-left:0px;margin-right:0px;">
                <div class="col-lg-3 col-md-6">
                    <a href="{{url('/')}}">
                        <img src="{{url('/logo.svg')}}" class="header_logo" alt="" >
                    </a>
                    <!-- <h2>The Brighter World</h2> -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <p class="header_thought" >"Dream, Dream, Dream!<br/>
                        Conduct these dreams into thoughts,<br/>
                        and then transform them into action."<br/>
                        - Dr. A. P. J. Abdul Kalam</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="search_form">
                        <form action="{{ route('search') }}" method="GET" class="input-group"> 
                            <input type="text" class="form-control" placeholder="Search here..." name="search" required/>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-warning" >Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex flex-row-reverse">
                    <div class="login_btn">
                        @if(session()->get("user_id"))
                        <a href="{{url('/logout')}}" class="btn btn-danger" >Logout</a>
                        @else
                        <a href="{{url('/login')}}" class="btn btn-warning " >Login</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="menu-btn d-flex flex-row-reverse">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="login_btn_sm d-none">
                        @if(session()->get("user_id"))
                        <a href="{{url('/logout')}}" class="btn btn-danger" >Logout</a>
                        @else
                        <a href="{{url('/login')}}" class="btn btn-warning " >Login</a>
                        @endif
                    </div>
                
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    @php $category = Helper::getCategory(4); @endphp
                    @foreach($category as $cat_row)
                  
                    <li class="nav-item">
                        <a class="nav-link {!! Route::is('category') && $cat_row->category_id == Helper::base64url_decode(request()->route()->parameters['category_id']) ? 'active' : '' !!} " href="{!! url('/').'/category/'.$cat_row->category_name.'/'.Helper::base64url_encode($cat_row->category_id) !!}">{{$cat_row->category_name}}</a>
                    </li>
               
                    @endforeach
                    
                    <li class="nav-item {{ Route::currentRouteNamed('facts') ? 'active' : '' }}">
                        <a class="nav-link " href="{{url('/').'/facts'}}">Facts</a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed('quotes') ? 'active' : '' }}">
                        <a class="nav-link" href="{{url('/').'/quotes'}}">Quotes</a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteNamed('about') ? 'active' : '' }}">
                        <a class="nav-link" href="{{url('/').'/about-us'}}">About us</a>
                    </li>
                    @if(session()->get("user_id") && Helper::getUser()->role != "user" )
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/admin')}}">Dashboard</a>
                    </li>
                    @endif
                   
                    
                    </ul>
                    
                </div>
            </nav>
        </div>
    </header>
