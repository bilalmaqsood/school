@extends('layouts.app')

@section('content')
    {!! Form::open(array('url'=>'student/save/'.SiteHelpers::encryptID($row['id']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'customerFormAjax')) !!}
    <div class="md-card" style="padding-left: 5%; padding-right: 10%;">
        <div class="md-card-content">
            <h3 class="heading_a text-orange">
                {{ Lang::get('customer.new_customer') }}</h3>
            <div class="md-card-head-menu" data-uk-dropdown="{pos:'bottom-right'}">
                <i class="md-icon material-icons">cancel</i>
                <div class="uk-dropdown uk-dropdown-small">
                    <ul class="uk-nav">
                        <li><a href="javascript:void(0)" onclick="ajaxViewClose('#{{ $pageModule }}')">{{ Lang::get('customer.close') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="uk-grid">
                <div class="uk-width-medium">
                    <div class="md-card-head">
                        <div class="uk-text-center">
                            {!! SiteHelpers::showUploadedProfileIamge($row['image'],'/uploads/users/', 'md-card-head-avatar') !!}
                            <div class="clearfix"></div>
                            <br />
                            <p class="uk-text-muted uk-text-small uk-margin-small-bottom"></p>
                            @if(!empty($info->image))
                                {{ Lang::get('customer.change_picture') }}
                            @else
                                {{ Lang::get('customer.upload_picture') }}
                            @endif
                            <p class="center"><input class="uk-form-file" style="padding-left: 12%;" type="file" name="image" value="{{  $row['image'] }}" ></p>
                        </div>
                    </div>

                    <div class="uk-form-row" style="display:none;">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">
                                <label for="Id">
                                    {!! SiteHelpers::activeLang('Id', (isset($fields['id']['language'])? $fields['id']['language'] : array())) !!}
                                </label>
                                {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1">
                                <?php
                                $category_opt = array( 1 => 'Private' ,  2 => 'Business'); ?>
                                <select name='type' rows='5'   class="dropdown-width" id='select1'  data-md-selectize-inline>
                                    <?php
                                    foreach($category_opt as $key=>$val)
                                    {
                                        echo "<option  value ='$key' ".($row['type'] == $key ? " selected='selected' " : '' ).">$val</option>";
                                    }
                                    ?></select>
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-row business">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">
                                <label for="First Name">
                                    {!! SiteHelpers::activeLang(Lang::get('customer.company_name'), (isset($fields['company_name']['language'])? $fields['company_name']['language'] : array())) !!}
                                </label>
                                {!! Form::text('company_name', $row['company_name'],array('class'=>'md-input', 'placeholder'=>'')) !!}
                            </div>
                            <div class="uk-width-medium-1-2">
                                <label for="Last Name">
                                    {!! SiteHelpers::activeLang(Lang::get('customer.contact_person'), (isset($fields['contact_person']['language'])? $fields['contact_person']['language'] : array())) !!}
                                </label>
                                {!! Form::text('contact_person', $row['contact_person'],array('class'=>'md-input', 'placeholder'=>'' )) !!}
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-row private">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">
                                <label for="First Name">
                                    {{ Lang::get('customer.first_name') }}
                                </label>
                                {!! Form::text('first_name', $row['first_name'],array('class'=>'md-input', 'placeholder'=>'')) !!}
                            </div>
                            <div class="uk-width-medium-1-2">
                                <label for="Last Name">
                                    {{ Lang::get('customer.last_name') }}
                                </label>
                                {!! Form::text('last_name', $row['last_name'],array('class'=>'md-input', 'placeholder'=>'')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-row" >
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">
                                <label for="Address">
                                    {{ Lang::get('customer.address') }}
                                </label>
                                {!! Form::text('address', $row['address'],array('class'=>'md-input', 'placeholder'=>'',  'required'=>'true' )) !!}
                            </div>
                            <div class="uk-width-medium-1-2">
                                <label for="Zip Code">
                                    {{ Lang::get('customer.zip_code') }}
                                </label>
                                {!! Form::text('zip_code', $row['zip_code'],array('class'=>'md-input', 'placeholder'=>'', 'required'=>'true'  )) !!}
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">
                                <label for="Address">
                                    {{ Lang::get('customer.city') }}
                                </label>
                                {!! Form::text('city', $row['city'],array('class'=>'md-input', 'placeholder'=>'',  'required'=>'true' )) !!}
                            </div>
                            <div class="uk-width-medium-1-2">
                                <label for="Telephone">
                                    {{ Lang::get('customer.telephone') }}
                                </label>
                                {!! Form::text('telephone', $row['telephone'],array('class'=>'md-input', 'placeholder'=>'', 'required'=>'true'  )) !!}
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">
                                <label for="Email">
                                    {{ Lang::get('customer.email') }}
                                </label>
                                {!! Form::email('email', $row['email'],array('class'=>'md-input', 'placeholder'=>'',  'required'=>'true')) !!}
                            </div>
                            <div class="uk-width-medium-1-2">
                                <label for="password">
                                    {{ Lang::get('customer.password') }}
                                </label>
                                @if($row['id'] == '')
                                    {!! Form::text('password', $row['password'],array('class'=>'md-input', 'placeholder'=>'',  'required'=>'true' )) !!}
                                @else
                                    {!! Form::text('password', '',array('class'=>'md-input', 'placeholder'=>'')) !!}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2 business">
                                <label for="CVR">
                                    {!! SiteHelpers::activeLang(Lang::get('customer.cvr'), (isset($fields['cvr']['language'])? $fields['cvr']['language'] : array())) !!}
                                </label>
                                {!! Form::text('cvr', $row['cvr'],array('class'=>'md-input', 'placeholder'=>'')) !!}
                            </div>
                            <div class="uk-width-medium-1-2 private">
                                <label for="Notes">
                                    {{ Lang::get('customer.notes') }}
                                </label>
                                {!! Form::text('notes', $row['notes'],array('class'=>'md-input', 'placeholder'=>'')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="uk-modal-footer uk-text-right">
                        <button type="button" onclick="ajaxViewClose('#{{ $pageModule }}')" class="md-btn md-btn-primary uk-modal-close">
                            {{ Lang::get('customer.close') }}
                        </button>
                        <button type="submit" class="md-btn md-btn-flat md-btn-primary"
                                id="snippet_new_save">{{ Lang::get('customer.add_customer') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>



    </div>
    {!! Form::close() !!}
@endsection

