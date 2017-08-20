@extends('layouts.default')

@section('title')
<title> Registrations </title>
@stop

@section('content')
<style>
    .user-info {border-radius: 2px; }
    .user-details { border-radius:2px; }
    .button-wrap{ margin-bottom:10px; }
</style>

<div style=" margin-top:10px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Registrations</div>
                <div style="float:right; position: relative; top:-20px">
                    <a id="view_reg" href="/contact">New</a>
                </div>
            </div>  
            <div class="panel-body" id="user_list"></div>
            <div class="text-center button-wrap">
                <button type="button" id="view_more_button" class="btn btn-primary">Load More...</button>
            </div>
            
        </div>
</div>
@stop

@section('js')
    <script> var first_users_list = JSON.parse(decodeURIComponent('{{$first_users_list}}'.replace(/\+/g, ' '))); </script>
    <script type="text/javascript" src="js/view-users.js"></script>
@stop