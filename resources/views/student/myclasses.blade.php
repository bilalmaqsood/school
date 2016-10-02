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
                                <th class="column-title">Class </th>
                                <th class="column-title">Division</th>
                                <th class="column-title">Status</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td class=" ">{{ $row->class_name }}</td>
                                    <td class=" ">{{ $row->division_name }}</td>
                                    <td class=" ">
                                        @if($row->status == -1)
                                            Pass out
                                        @elseif($row->status == 0)
                                            Current
                                        @elseif($row->status == 3)
                                            Fail
                                        @elseif($row->status == 1 || $row->status == 2)
                                            Pass
                                        @endif
                                    </td>
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