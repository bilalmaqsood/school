<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Parent Profile</h2>
            <a href="javascript:void(0)" class="pull-right close-link"
               onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa-close"></i></a>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <table class="personal_details">

                    <tr>
                        <td><label>Last Name</label></td>
                        <td>{{ucwords($row->last_name)}}</td>
                        <td><label>City</label></td>
                        <td>{{ucwords($row->city)}}</td>
                    </tr>

                    <tr>
                        <td><label>Middle Name </label></td>
                        <td>{{ucwords($row->middle_name)}}</td>
                        <td><label>Country/State </label></td>
                        <td>{{ucwords($row->country)}}</td>
                    </tr>
                    <tr>
                        <td><label>First Name</label></td>
                        <td>{{ucwords($row->first_name)}}</td>
                        <td><label>Phone No</label></td>
                        <td>{{$row->phone_number}}</td>
                    </tr>
                    <tr>
                        <td><label>Relationship to Student</label></td>
                        <td>{{ ucwords($row->relation) }}</td>
                        <td><label>Mobile No</label></td>
                        <td>{{$row->phone_number}}</td>
                    </tr>
                    <tr>
                        <td><label>Occupation</label></td>
                        <td>{{ ucwords($row->occupcation) }}</td>
                        <td><label>Email Address</label></td>
                        <td>{{$row->email}}</td>
                    </tr>
                    <tr>
                        <td><label>Community</label></td>
                        <td>{{ ucwords($row->community) }}</td>
                        <td><label>Gender</label></td>
                        <td>{{ \SiteHelpers::getGender($row->gender) }}</td>

                    </tr>

                </table>

            </div>
        </div>

    </div>
</div>
