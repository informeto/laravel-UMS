@extends('layouts.default')

@section('title')
<title> Register </title>
@stop

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stop

@section('content')
<style>
    .bottom-space{ margin-bottom:10px; }
</style>
    <div id="register_box" style=" margin-top:10px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Registration</div>
                <div style="float:right; position: relative; top:-20px">
                    <a id="view_reg" href="/registration/view">View Registrations</a>
                </div>
            </div>  
            <div class="panel-body" >
                    <form  class="form-horizontal" method="post" id="register-form">
                        {{ csrf_field() }}
                        <div id="div_id_name" class="form-group required"> 
                            <label for="id_name" class="control-label col-md-4  requiredField"> Name  </label> 
                            <div class="controls col-md-8 "> 
                                <input class="input-md textinput textInput form-control"  id="id_name" name="name" placeholder="Full Name"type="text" data-validation="custom" data-validation-regexp="^[a-zA-Z\s]{5,30}$" data-sanitize="trim"  data-validation-error-msg="Please enter your full name."/>
                            </div>
                        </div>
                        
                        <div id="div_id_gender" class="form-group required">
                            <label for="id_gender"  class="control-label col-md-4  requiredField"> Gender </label>
                            <div class="controls col-md-8 "  style="margin-bottom: 10px">
                                <label class="radio-inline"> <input type="radio" name="gender" required id="id_gender_1" value="M"  style="margin-bottom: 10px">Male</label>
                                 <label class="radio-inline"> <input type="radio" name="gender" id="id_gender_2" value="F"  style="margin-bottom: 10px">Female </label>
                            </div>
                        </div>
                        
                        <div id="div_id_email" class="form-group required">
                            <label for="id_email" class="control-label col-md-4  requiredField"> E-mail </label>
                            <div class="controls col-md-7">
                                <input class="input-md emailinput form-control" id="id_email" name="email" placeholder="Your  email address"type="email" data-validation="email" data-sanitize="trim"  data-validation-error-msg="Please enter a valid email."/>
                            </div>     
                        </div>
                        
                        <div id="div_id_number" class="form-group required">
                             <label for="id_number" class="control-label col-md-4  requiredField"> Phone  </label>
                             <div class="controls col-md-7">
                                 <input class="input-md textinput textInput form-control" id="id_number" name="number" placeholder="Contact number" type="text"  data-validation="custom" data-validation-regexp="^\+?([0-9]{0,3})\)?[-. ]?([0-9]{9,11})$" data-validation-error-msg="Please enter a correct phone number."/>
                             </div> 
                        </div>
                        
                        <div class="form-group">
                            <label for="id_pref_comm" class="control-label col-md-4  requiredField" >Primary contact</label>
                            <div class="controls col-md-8 ">
                                <select class="input-md textinput textInput form-control" name="pref_comm" id="id_pref_comm">
                                    <option value="none">Any</option>
                                    <option value="email">Email</option>
                                    <option value="phone">Phone</option>
                                </select>
                            </div>
                            
                        </div>
                        
                        <div id="div_id_number" class="form-group required">
                             <label for="id_number" class="control-label col-md-4  requiredField"> DOB  </label>
                             <div class="controls col-md-8">
                                 <input class="input-md textinput  form-control" type="text" name="birthdate" placeholder="DD/MM/YYYY" data-validation="birthdate" data-validation-format="dd/mm/yyyy" data-validation-error-msg="Please enter a date in DD/MM/YYYY format.">
                            </div> 
                        </div>
                        <div id="div_id_company" class="form-group required"> 
                            <label for="id_company" class="control-label col-md-4  requiredField"> Education </label>
                            <div class="controls col-md-8 " >
                                <div id="education_fields">
                                </div>
                                <button type="button" id="add_field_button" class="btn btn-default">Add Education</button>
                            </div>
                            
                        </div> 
                        
                        <div id="div_id_location" class="form-group required">
                            <label for="id_location" class="control-label col-md-4  requiredField"> Nationality </label>
                            <div class="controls col-md-8 ">
                                <input class="input-md textinput textInput form-control" id="id_nationality" name="nationality" placeholder="Country" style="" type="text" data-validation="country"  data-validation-error-msg="Please choose a country."/>
                            </div> 
                        </div>
                        
                        <div id="div_id_address" class="form-group required"> 
                            <label for="id_address" class="control-label col-md-4  requiredField"> Address  </label> 
                            <div class="controls col-md-8 "> 
                                <input id="address-line1" class="input-md textinput form-control bottom-space" name="address-line1" type="text" placeholder="address line 1" class="input-xlarge" data-validation="length" data-validation-length="5-100" data-validation-error-msg="Please enter a valid address.">
                                <input id="address-line2" class="input-md textinput form-control bottom-space" name="address-line2" type="text" placeholder="address line 2" class="input-xlarge">
                                <input id="city" name="city" class="input-md textinput form-control bottom-space" type="text" placeholder="city" class="input-xlarge" data-validation="length" data-validation-length="3-100" data-validation-error-msg="Please enter a valid city.">
                                <input id="region" name="region" class="input-md textinput form-control bottom-space" type="text" placeholder="state / province / region" class="input-xlarge" data-validation="length" data-validation-length="2-50" data-validation-error-msg="Please enter a valid region.">
                                <input id="postal-code" name="postal-code" class="input-md textinput form-control bottom-space" type="text" placeholder="zip or postal code" class="input-xlarge" data-validation="custom" data-validation-regexp="^[1-9][0-9]{3,7}$" data-validation-error-msg="Please enter a valid postal code.">
                                <input id="id_country" name="country" class="input-md textinput form-control bottom-space" placeholder="Country" type="text" data-validation="country" data-validation-error-msg="Please choose a country."/>
                            </div>
                        </div>
                        
                        <div class="form-group"> 
                            <div class="controls text-center">
                                    <input type="submit" name="Register" value="Register" class="btn btn-primary" id="submit-id-signup" />
                            </div>
                                
                        </div> 
                            
                    </form>
            </div>
        </div>
    </div> 
@stop

@section('js')
    <script type="text/javascript" src="/js/receiver.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@stop