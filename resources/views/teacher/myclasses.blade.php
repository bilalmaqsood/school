@extends('layouts.app')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{ 'My Classes' }} <small>{{ ' view all assigned class in current year' }}</small></h3>
            </div>
            <div class="title_right">

            </div>
        </div>
        <div class="clearfix"></div>
        <!-- Begin Content -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ 'My Classes' }} <small>{{ ' view all assigned class in current year' }}</small></h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <table class="table table-striped responsive-utilities jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">ID </th>
                                <th class="column-title">Class</th>
                                <th class="column-title">Division</th>
                                <th class="column-title">Total Students</th>
                                <th class="column-title">Action</th>


                            </tr>
                            </thead>
                            <tbody>
                            @if(count($rows) > 0)
                                @foreach($rows as $index => $row)
                                    <tr>
                                        <td class=" ">{{ ++$index }}</td>
                                        <td class=" ">{{ $row->class_name }}</td>
                                        <td class=" ">{{ $row->division_name }}</td>
                                        <td class=" ">{{ \SiteHelpers::total_students($row->id) }}</td>
                                        <td>
                                        @if(\SiteHelpers::total_students($row->id) > 0)
                                            <a class="btn btn-xs btn-primary" href="{{ URL::to('student/student-list/'.$row->id) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>No Record Found</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Content -->
    </div>
@endsection