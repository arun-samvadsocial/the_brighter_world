<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{url('admin')}}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if(auth()->user()->role == 'admin')
                <li class="menu-title">User Panel</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-user"></i>
                        <span>User Panel</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/user-list')}}">User List</a></li>
                        <li><a href="{{url('admin/add-user')}}">Add User</a></li>
                        <!-- <li><a href="{{url('admin/author-profiles')}}">Author Profiles</a></li> -->
                    </ul>
                </li>
                @endif

                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'moderator')

                <li class="menu-title">Main Menu</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-layout-grid2"></i>
                        <span>Categories</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/category-list')}}">Categories</a></li>
                        <li><a href="{{url('admin/add-category')}}">Add new category</a></li>
                    </ul>
                </li>
<!-- Sub Category Menu -->
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-layout-grid3"></i>
                        <span>Sub-Categories</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/sub-category-list')}}">Sub-categories</a></li>
                        <li><a href="{{url('admin/add-sub-category')}}">Add new sub-categories</a></li>
                    </ul>
                </li> -->
                @endif
<!-- Posts Menu -->
                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'author' || auth()->user()->role == 'moderator')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-layout-list-thumb"></i>
                        <span>Posts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/all-posts')}}">All posts</a></li>
                        <li><a href="{{url('admin/add-new-single-post')}}">Add new single post</a></li>
                        <!-- <li><a href="{{url('admin/sub-categories')}}">Add new multi post</a></li> -->
                    </ul>
                </li>
                @endif
<!-- Tips Menu  -->
                @if(auth()->user()->role == 'admin' || auth()->user()->role == 'moderator')
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-info-alt"></i>
                        <span>Tips</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/tips-list')}}">All Tips</a></li>
                        <li><a href="{{url('admin/add-tips')}}">Add new Tip</a></li>
                    </ul>
                </li> -->
<!-- Facts Menu  -->
<li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-thought"></i>
                        <span>Facts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/facts-list')}}">All Facts</a></li>
                        <li><a href="{{url('admin/add-facts')}}">Add new Facts</a></li>
                    </ul>
                </li>
<!-- Tags Menu  -->
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-tag"></i>
                        <span>Tags</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/tags-list')}}">All tags</a></li>
                        <li><a href="{{url('admin/add-tags')}}">Add new tag</a></li>
                    </ul>
                </li> -->
<!-- Facts Menu  -->
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-save-alt"></i>
                        <span>Facts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/all-facts')}}">All fatcs</a></li>
                        <li><a href="{{url('admin/add-new-fact')}}">Add new fact</a></li>
                    </ul>
                </li> -->
<!-- Quotes Menu  -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-quote-left"></i>
                        <span>Quotes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/quotes-list')}}">All Quotes</a></li>
                        <li><a href="{{url('admin/add-quotes')}}">Add new Quote</a></li>
                    </ul>
                </li>

                
<!-- Subscribers Menu  -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-email"></i>
                        <span>Subscribers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{url('admin/subscribers')}}" class="waves-effect">
                            <!-- <i class="ti-email"></i> -->
                            <span>All Email Subscribers</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/add-subscribers')}}" class="waves-effect">
                                <!-- <i class="ti-plus"></i> -->
                                <span>Add Email Subscribers</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{url('admin/whatsapp-subscribers')}}" class="waves-effect">
                                <!-- <i class="ion ion-logo-whatsapp"></i> -->
                                <span>All Whatsapp Subscribers</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/add-whatsapp-subscribers')}}" class="waves-effect">
                                <!-- <i class="ti-plus"></i> -->
                                <span>Add Whatsapp Subscribers</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
<!-- Buy Button Menu   -->
                <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ti-shopping-cart"></i>
                            <span>Buy Button</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{url('admin/buy-button-list')}}" class="waves-effect">
                                        
                                        <span>Buy Buttons List</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('admin/add-buy-button')}}" class="waves-effect">
                                        <span>Add Buy Button</span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                </li>
<!-- Video Manager Menu  -->
                <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ti-video-clapper"></i>
                            <span>Videos</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                                <li>
                                    <a href="{{url('admin/videos')}}" class="waves-effect">
                                        
                                        <span>Videos</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('admin/add-video')}}" class="waves-effect">
                                        <span>Add Video</span>
                                    </a>
                                </li>
                        </ul>
                    </li>
                </li>

<!-- Pages Menu  -->
                <!-- <li class="menu-title">Pages</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ti-layout"></i>
                            <span>Pages</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{url('admin/home-page')}}">Home page</a></li>
                            <li><a href="{{url('admin/about-us')}}">About us</a></li>
                            <li><a href="{{url('admin/contact-us')}}">Contact us</a></li>
                            <li><a href="{{url('admin/terms-conditions')}}">Terms & Conditions</a></li>
                            <li><a href="{{url('admin/privacy-policy')}}">Privacy & Payment Policy</a></li>
                        </ul>
                    </li> -->
<!-- Settings Menu  -->
                <!-- <li class="menu-title">Settings</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ti-settings"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{url('admin/general-settings')}}">General Settings</a></li>
                            <li><a href="{{url('admin/user-settings')}}">User Settings</a></li>
                            <li><a href="{{url('admin/payment-settings')}}">Payment Settings</a></li>
                        </ul>
                    </li> -->
<!-- Cron Job Menu  -->
                <!-- <li>
                    <a href="{{url('admin/cron-job')}}" class="waves-effect">
                        <i class="ti-reload"></i>
                        <span>Cron Job</span>
                    </a>
                </li> -->
            @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->