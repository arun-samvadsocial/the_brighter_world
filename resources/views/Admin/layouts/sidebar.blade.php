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
                @if(Helper::getUser()->role == 'admin')
                <li class="menu-title">User Panel</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-user"></i>
                        <span>User Panel</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/add-user')}}">Add User</a></li>
                        <li><a href="{{url('admin/user-list')}}">User List</a></li>
                    </ul>
                </li>
                @endif

                @if(Helper::getUser()->role == 'admin' || Helper::getUser()->role == 'moderator')

                <li class="menu-title">Main Menu</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-layout-grid2"></i>
                        <span>Categories</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/add-category')}}">Add new category</a></li>
                        <li><a href="{{url('admin/category-list')}}">Categories</a></li>
                    </ul>
                </li>

                @endif
<!-- Posts Menu -->
                @if(Helper::getUser()->role == 'admin' || Helper::getUser()->role == 'author' || Helper::getUser()->role == 'moderator')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-layout-list-thumb"></i>
                        <span>Posts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/add-new-single-post')}}">Add new single post</a></li>
                        <li><a href="{{url('admin/all-posts')}}">All posts</a></li>
                        <!-- <li><a href="{{url('admin/sub-categories')}}">Add new multi post</a></li> -->
                    </ul>
                </li>
                @endif

                @if(Helper::getUser()->role == 'admin' || Helper::getUser()->role == 'moderator')
               
<!-- Facts Menu  -->
<li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-thought"></i>
                        <span>Facts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/add-facts')}}">Add new Facts</a></li>
                        <li><a href="{{url('admin/facts-list')}}">All Facts</a></li>
                    </ul>
                </li>

<!-- Quotes Menu  -->
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-quote-left"></i>
                        <span>Quotes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('admin/add-quotes')}}">Add new Quote</a></li>
                        <li><a href="{{url('admin/quotes-list')}}">All Quotes</a></li>
                    </ul>
                </li>

               

<!-- Video Manager Menu  -->
                
                    <li><a href="{{url('admin/comments')}}">
                    <i class="ti-comments"></i><span>Comments</span></a></li>
                </li>

            @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->