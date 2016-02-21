@extends('admin.master')
@section('page-header')
    User
    <small>Edit</small>
@endsection
@section('content')
    <div class="col-lg-7" style="padding-bottom:120px">
        <form action="" method="POST">
            <input type="hidden" name="_token" value="{!!  csrf_token() !!}" />
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" name="txtUser" value="{!! old('txtUser',isset($user)?$user['username']:null) !!}" disabled />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="txtPass" placeholder="Please Enter Password" />
            </div>
            <div class="form-group">
                <label>RePassword</label>
                <input type="password" class="form-control" name="txtRePass" placeholder="Please Enter RePassword" />
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="txtEmail" placeholder="Please Enter Email" value="{!! old('txtEmail',isset($user)?$user['email']:null) !!}"/>
            </div>
            @if(Auth::user()->id != $user->id)
            <div class="form-group">
                <label>User Level</label>
                <label class="radio-inline">
                    <input name="rdoLevel" value="1" 
                    @if($user['level'] == 1)
                        checked="checked" 
                    @endif
                     type="radio">Admin
                </label>
                <label class="radio-inline">
                    <input name="rdoLevel" value="2" 
                    @if($user['level'] == 2)
                        checked="checked" 
                    @endif
                    type="radio">Member
                </label>
            </div>
            @endif
            <button type="submit" class="btn btn-default">User Edit</button>
            <button type="reset" class="btn btn-default">Reset</button>
        <form>
    </div>
@endsection