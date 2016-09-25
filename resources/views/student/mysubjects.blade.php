@extends('layouts.app')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{ 'My Subject' }} <small>{{ ' in current class and year' }}</small></h3>
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
                        @if(!empty($class))
                            Class: {{ ucwords($class).' - Division: '.ucwords($division) }}
                        @else
                            <h2>{{ 'My Subject' }} <small>{{ ' in current class and year' }}</small></h2>
                        @endif
                            <span class="nav navbar-right panel_toolbox">
                            @if(!empty($status))
                                Status:
                                @if($status == 0)
                                    <span>Current</span>
                                @elseif($status == 1 || $row->status == 2)
                                    <span>Pass</span>
                                @elseif($status == 3)
                                    <span>Fail</span>
                                @endif
                            @endif
                            </span>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <table class="table table-striped responsive-utilities jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">ID </th>
                                <th class="column-title">Subject Name</th>
                                <th class="column-title">Teacher Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($rows) > 0)
                                @foreach($rows as $index => $row)
                                    <tr>
                                        <td class=" ">{{ ++$index }}</td>
                                        <td class=" ">{{ ucwords($row->subject_name) }}</td>
                                        <td class=" ">{{ ucwords($row->first_name.' '.$row->last_name) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td></td>
                                    <td class="center">No Record Found</td>
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