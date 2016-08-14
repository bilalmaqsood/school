@extends('layouts.app')

@section('content')


        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>
                    New Admission
                </h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Personal Details</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  {{-- <form class="form-horizontal form-label-left input_mask"> --}}

                {!! Form::open(array('url'=>'student/save/', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'customerFormAjax')) !!}

                    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                    <label>Last name *:</label>
                      <input type="text" class="form-control" id="inputSuccess3" placeholder="Last Name">
                      
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                    <label>Middle name *:</label>
                      <input type="text" class="form-control" id="inputSuccess2" placeholder="Middle Name">
                      
                    </div>



                    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                            <label>First name *:</label>
                      <input type="text" class="form-control" id="inputSuccess4" placeholder="Email">
                      
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                      <label>Gender *:</label>
                    <p>
                      M:
                      <input type="radio" class="flat" name="gender" id="genderM" value="M" checked="" required /> F:
                      <input type="radio" class="flat" name="gender" id="genderF" value="F" />
                    </p>

                    </div>

                   
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>

                  {{-- </form> --}}
                </div>
              </div>
              </div>

            </div>
          </div>
        
      


   {{--  {!! Form::open(array('url'=>'student/save/'.SiteHelpers::encryptID($row['id']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'customerFormAjax')) !!} --}}

  

    {!! Form::close() !!}
 

@stop

      @section('js_section');
 <script>
    // initialize the validator function
    validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
      .on('blur', 'input[required], input.optional, select.required', validator.checkField)
      .on('change', 'select.required', validator.checkField)
      .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required')
      .on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

    $('form').submit(function(e) {
      e.preventDefault();
      var submit = true;
      // evaluate the form using generic validaing
      if (!validator.checkAll($(this))) {
        submit = false;
      }

      if (submit)
        this.submit();
      return false;
    });

    /* FOR DEMO ONLY */
    $('#vfields').change(function() {
      $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function() {
      validator.defaults.alerts = (this.checked) ? false : true;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false);
  </script>
@stop