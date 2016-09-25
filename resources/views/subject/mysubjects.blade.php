@extends('layouts.app')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{ 'My Classes' }} <small>{{ ' view current and previous classes' }}</small></h3>
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
                        <h2>{{ 'My Classes' }} <small>{{ ' view current and previous classes' }}</small></h2>
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
                            @foreach($rows as $index => $row)
                                <tr>
                                    <td class=" ">{{ ++$index }}</td>
                                    <td class=" ">{{ ucwords($row->subject_name) }}</td>
                                    <td class=" ">{{ ucwords($row->first_name.' '.$row.last_name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Content -->
    </div>
@endsection