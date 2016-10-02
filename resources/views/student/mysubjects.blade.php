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
        @foreach($rows as $row)
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            @if(!empty($row->class_name))
                                Class: {{ ucwords($row->class_name).' - Division: '.ucwords($row->division_name) }}
                            @else
                                <h2>{{ 'My Subject' }} <small>{{ ' in current class and year' }}</small></h2>
                            @endif
                            <span class="nav navbar-right panel_toolbox">
                            @if(!empty($row->status))
                                    Status:
                                    @if($row->status == -1)
                                        Pass out
                                    @elseif($row->status == 0)
                                        Current
                                    @elseif($row->status == 3)
                                        Fail
                                    @elseif($row->status == 1 || $row->status == 2)
                                        Pass
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
                                @if(count($row->subjects) > 0)
                                    @foreach($row->subjects as $index => $subject)
                                        <tr>
                                            <td class=" ">{{ ++$index }}</td>
                                            <td class=" ">{{ ucwords($subject->subject_name) }}</td>
                                            <td class=" ">{{ ucwords($subject->first_name.' '.$subject->last_name) }}</td>
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
        @endforeach
    </div>
@endsection