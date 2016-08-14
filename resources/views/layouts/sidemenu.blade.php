<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>{{ CNF_APPNAME }}</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3>General</h3>

                <ul class="nav side-menu">
                    <li>
                        <a href="javascript:void(0)"><i class="fa fa-home"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="{ URL::to('dashboard') }}"><i class="fa fa-users"></i>Students</a>
                    </li>
                    <li>
                        <a href="{ URL::to('dashboard') }}"><i class="fa fa-graduation-cap"></i>Teachers</a>
                    </li>
                    <li>
                        <a href="{ URL::to('dashboard') }}"><i class="fa fa-file-code-o"></i>Classes</a>
                    </li>
                    <li>
                        <a href="{ URL::to('dashboard') }}"><i class="fa fa-book"></i>Subjects</a>
                    </li>
                    <li>
                        <a href="{ URL::to('dashboard') }}"><i class="fa fa-newspaper-o"></i>News</a>
                    </li>
                    <li>
                        <a href="{ URL::to('dashboard') }}"><i class="fa fa-bars"></i>Events</a>
                    </li>
                    <li>
                        <a href="{ URL::to('dashboard') }}"><i class="fa fa-bank"></i>Finance</a>
                    </li>
                    <li>
                        <a><i class="fa fa-cog"></i> Others <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            <li><a href="page_404.html">General Settings</a>
                            </li>
                            <li><a href="page_500.html">Permission Settings</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
