@extends('layouts.app')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{ $pageTitle }}</small></h3>
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
            <h2>Module Permissions</h2>
            
            <div class="clearfix"></div>
        </div>  
                <div class="x_content">


                  <div class="" role="tabpanel" data-example-id="togglable-tabs">

                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <?php 

                    $counter=0;
                    ?>
                    @foreach ($module as $md)

                    @if($counter==0)

                <li role="presentation" class="active"><a href="#tab_content{{$md->id}}" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">{{$md->name}}</a>

                </li>

                    @else
            

                    <li role="presentation"><a href="#tab_content{{$md->id}}" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">{{$md->name}}</a>
                      </li>
                      @endif
                      <?php 

                    $counter++;
                    ?>
                  @endforeach
                      
                      {{-- <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Parent Details</a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Parent Details</a>
                      </li> --}}
                                        </ul>
        <div id="myTabContent" class="tab-content">
        
        
        @foreach ($module as $md)
                     
                  

                      <div role="tabpanel" class="tab-pane fade" id="tab_content{{$md->id}}" aria-labelledby="profile-tab">
                        <div data-example-id="bordered-table" class="bs-example"> 
    <table class="table table-bordered table-striped table-hover"> 
        <thead> 
            <tr> 
                <th>#</th> 
                <th>Users</th> 
                <th>Add</th> 
                <th>Edit</th> 
                <th>Delete</th> 
                <th>View</th> 
            </tr> 
        </thead> 
            <tbody> 
            <tr> 
                <th scope="row">1</th> 
                <td>User</td> 
                <td><input type="checkbox" value=""></td> 
                <td><input type="checkbox" value=""></td> 
                <td><input type="checkbox" value=""></td> 
                <td><input type="checkbox" value=""></td> 
                </tr> 
                <tr> <th scope="row">2</th> 
                <td>Admin</td> 
                <td><input type="checkbox" value=""></td> 
                <td><input type="checkbox" value=""></td> 
                <td><input type="checkbox" value=""></td>  
                <td><input type="checkbox" value=""></td>  
                </tr> 
                <tr> <th scope="row">3</th> 
                <td>Teacher</td> 
                <td><input type="checkbox" value=""></td> 
                <td><input type="checkbox" value=""></td> 
                <td><input type="checkbox" value=""></td> 
                <td><input type="checkbox" value=""></td> 
                </tr>
                <tr> <th scope="row">4</th> 
                <td>Student</td> 
                <td><input type="checkbox" value=""></td> 
                <td><input type="checkbox" value=""></td> 
                <td><input type="checkbox" value=""></td> 
                <td><input type="checkbox" value=""></td> 
                </tr> 
            </tbody> 
        </table> 
        <button class="btn btn-success pull-right">Save</button>
        <a href="javascript:void(0)" class="btn btn-primary pull-right" onclick="ajaxViewClose('#{{ $pageModule }}')">Cancel</a>
    </div>
                      </div>
                      @endforeach
                      
                    </div>
                  </div>

                </div>
              </div>
              </div>
    </div>
    <!-- End Content -->
    </div>
    <script>
        $(document).ready(function(){
            reloadData('#{{ $pageModule }}','{{ $pageModule }}/data');
        $("a[href='#tab_content2']").click();
        $("a[href='#tab_content1']").click();
        
        });

    </script>
@endsection

@section('js_section')


@stop