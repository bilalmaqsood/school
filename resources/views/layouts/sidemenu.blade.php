<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>{{ CNF_APPNAME }}</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{{ asset('images/img.jpg') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3>General</h3>

                <ul class="nav side-menu">
                    @if(\Session::get('sidemenu')[0] == 1)
                        <li>
                            <a href="dashboard"><i class="fa fa-home"></i>Dashboard</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[1] == 1)
                        <li>
                            <a href="{{ URL::to('student') }}"><i class="fa fa-users"></i>Students</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[2] == 1)
                        <li>
                            <a href="{{ URL::to('teacher') }}"><i class="fa fa-graduation-cap"></i>Teachers</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[3] == 1)
                        <li>
                            <a href="{{ URL::to('') }}"><i class="fa fa-users"></i>Parents</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[4] == 1)
                        <li>
                            <a href="{{ URL::to('division') }}"><i class="fa fa-table"></i>Divisions</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[5] == 1)
                        <li>
                            <a href="{{ URL::to('class') }}"><i class="fa fa-table"></i>Classes</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[6] == 1)
                        <li>
                            <a href="{{ URL::to('subject') }}"><i class="fa fa-book"></i>Subjects</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[7] == 1)
                        <li>
                            <a><i class="fa fa-table"></i> Classes Schedule <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li><a href="{{ URL::to('period') }}">Periods Management</a>
                                </li>
                                <li><a href="{{ URL::to('schedule') }}">Classes Schedule</a>
                                </li>
                                <li><a href="{{ URL::to('schedule') }}">Classes Schedule List</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[8] == 1)
                        <li>
                            <a href="{{ URL::to('calender') }}"><i class="fa fa-table"></i>School Calender</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[9] == 1)
                        <li>
                            <a href="{{ URL::to('news') }}"><i class="fa fa-newspaper-o"></i>News</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[10] == 1)
                        <li>
                            <a href="{{ URL::to('event') }}"><i class="fa fa-bullhorn"></i>Events</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[11] == 1)
                        <li>
                            <a><i class="fa fa-book"></i> Grading System <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li><a href="{{ URL::to('gradebook/manage-marks') }}">Manage Marks</a>
                                </li>
                                <li><a href="{{ URL::to('gradebook') }}">Master Grade Book</a>
                                </li>
                                <li><a href="{{ URL::to('gradesheet') }}">Grade Sheet</a>
                                </li>
                                <li><a href="page_500.html">Transcript</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[12] == 1)
                        <li>
                            <a><i class="fa fa-university"></i> Finance <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li><a href="page_404.html">Fees Payment</a>
                                </li>
                                <li><a href="page_500.html">Receipt</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[13] == 1 && \Session::get('gid') == 1)
                        <li>
                            <a><i class="fa fa-asterisk"></i>Administrator Task <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li><a href="page_404.html">General Setting</a>
                                </li>
                                <li><a href="page_500.html">Backup & Restore</a>
                                </li>
                                <li><a href="{{ URL::to('setting/sidemenu') }}">Module Permission Setting</a>
                                </li>
                                <li><a href="page_500.html">User Role</a>
                                </li>

                            </ul>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[14] == 1)
                        <li>
                            <a href="{{ URL::to('') }}"><i class="fa fa-file-image-o"></i>Media Center</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
