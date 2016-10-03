@extends('layouts.app')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{ 'My Subjects' }} <small>{{ ' view all assigned subject in current year' }}</small></h3>
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
                        <h2>{{ 'My Subjects' }} <small>{{ ' view all assigned subject in current year' }}</small></h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <table class="table table-striped responsive-utilities jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">ID </th>
                                <th class="column-title">Subject</th>
                                <th class="column-title">Class</th>
                                <th class="column-title">Division</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($rows) > 0)
                                @foreach($rows as $index => $row)
                                    <tr>
                                        <td class=" ">{{ ++$index }}</td>
                                        <td class=" ">{{ ucwords($row->subject_name) }}</td>
                                        <td class=" ">{{ ucwords($row->class_name) }}</td>
                                        <td class=" ">{{ ucwords($row->division_name) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
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