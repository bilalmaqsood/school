<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>{{ CNF_APPNAME }}</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <!--<img src="{{ asset('images/img.jpg') }}" alt="..." class="img-circle profile_img">-->

                {!! SiteHelpers::showUploadedProfileIamge(\Session::get('favatar'),'/', 'img-circle profile_img',80,60) !!}
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ \Session::get('fid') }}</h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3>
                    {{ \Session::get('gname') }}
                </h3>

                <ul class="nav side-menu">
                    <li>
                        <select id="school_year"class="form-control">
                            @foreach(\Session::get('school_year') as $school_year)
                                <option value="{{ $school_year->id }}" @if(\Session::get('selected_year') == $school_year->id) {{ 'selected'  }}@endif>{{ $school_year->year }}</option>
                            @endforeach
                        </select>

                    </li>
                    @if(\Session::get('sidemenu')[0] == 1)
                        <li>
                            <a href="{{ URL::to('dashboard') }}"><i class="fa fa-home"></i>Dashboard</a>
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
                            <a href="{{ URL::to('parents') }}"><i class="fa fa-users"></i>Parents</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[4] == 1)
                        <li>
                            <a href="{{ URL::to('division') }}"><i class="fa fa-table"></i>Divisions</a>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[5] == 1)
                        <li>
                            @if(\Session::get('gid') == 6)
                                <a href="{{ URL::to('class/student-classes') }}"><i class="fa fa-book"></i>Classes</a>
                            @elseif(\Session::get('gid') == 5)
                                <a href="{{ URL::to('class/teacher-classes') }}"><i class="fa fa-book"></i>Classes</a>
                            @else
                                <a href="{{ URL::to('class') }}"><i class="fa fa-table"></i>Classes</a>
                            @endif
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[6] == 1)
                        <li>
                            @if(\Session::get('gid') == 6)
                                <a href="{{ URL::to('subject/student-subject') }}"><i class="fa fa-book"></i>Subjects</a>
                            @elseif(\Session::get('gid') == 5)
                                <a href="{{ URL::to('subject/teacher-subject') }}"><i class="fa fa-book"></i>Subjects</a>
                            @else
                                <a href="{{ URL::to('subject') }}"><i class="fa fa-book"></i>Subjects</a>
                            @endif
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[7] == 1)
                        <li>
                            <a><i class="fa fa-table"></i> Classes Schedule <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                @if(\Session::get('gid') != 5 && \Session::get('gid') != 6)
                                    <li><a href="{{ URL::to('period') }}">Periods Management</a>
                                    </li>
                                @endif
                                <li><a href="{{ URL::to('schedule') }}">Classes Schedule</a>
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
                                @if(\Session::get('gid') == 6)
                                    <li>
                                        <a href="{{ URL::to('gradebook/student-grade-sheet') }}">My Grade Sheet</a>
                                    </li>
                                @elseif(\Session::get('gid') == 5)
                                    <li><a href="{{ URL::to('gradebook') }}">Manage Marks</a>
                                    </li>
                                    <li><a href="{{ URL::to('gradebook/show') }}">Master Grade Book</a>
                                    </li>
                                @else
                                    <li><a href="{{ URL::to('generate') }}">Generate Grade Sheet</a>
                                    </li>
                                    <li><a href="{{ URL::to('promote') }}">Promote Students</a>
                                    </li>
                                    <li><a href="{{ URL::to('gradebook') }}">Manage Marks</a>
                                    </li>
                                    <li><a href="{{ URL::to('gradebook/show') }}">Master Grade Book</a>
                                    </li>
                                    <li><a href="{{ URL::to('gradesheet') }}">Grade Sheet</a>
                                    </li>
                                    <li><a href="{{ URL::to('gradebook/transcript') }}">Transcript</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[12] == 1)
                        <li>
                            <a><i class="fa fa-university"></i> Finance <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                @if(\Session::get('gid') == 6)
                                    <li><a href="{{ URL::to('receipt') }}">Receipt</a>
                                    </li>
                                @else
                                    <li><a href="{{ URL::to('finance') }}">Fees Payment</a>
                                    </li>
                                    <li><a href="{{ URL::to('receipt') }}">Receipt</a>
                                    </li>
                                @endif

                            </ul>
                        </li>
                    @endif
                    @if(\Session::get('sidemenu')[13] == 1)
                        <li>
                            <a><i class="fa fa-asterisk"></i>Administrator Task <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                @if(\Session::get('gid') == 1)
                                    <li><a href="{{ URL::to('setting') }}">Manage School</a>
                                    </li>
                                @endif
                                <li><a href="{{ URL::to('setting/general') }}">General Setting</a>
                                </li>
                                <li><a href="{{ URL::to('setting/moduleaccess') }}">User Role</a>
                                </li>
                                <li><a href="{{ URL::to('setting/sidemenu') }}">Module Permission Setting</a>
                                </li>
                                <li><a href="{{ URL::to('setting/backup') }}">Backup</a>
                                </li>
                                <li><a href="{{ URL::to('setting/restore') }}">Restore</a>
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
<script>
    $("#school_year").on('change', function () {
        var id = $(this).val();
        if(id != '')
        {
            var datas = {
                    id: id
            };
            $.get('/user/change-year',datas ,function( data ) {
                if(data.status =='success')
                {
                    notyMessage(data.message);
                    window.location.reload();
                } else {

                }
            });
        }
    });
</script>
