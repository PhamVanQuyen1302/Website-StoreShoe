@extends('layouts.master')
@section('title')
    Đặt mật khẩu mới
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-xs-12 wrapbox-heading-page">
            <div class="header-page clearfix">
                <h1>Quên mật khẩu</h1>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 wrapbox-content-page ">
            <div id="customer-login">
                <div id="login" class="userbox">
                    <div class="accounttype">
                        <h2 class="title"></h2>
                    </div>
                    <div id="customer_login">
                        <form method="post" action="">
                            <ul>
                                <li>
                                    <label for="newpassword" class="required">
                                        <span>*</span> Nhập mật khẩu mới:
                                    </label>
                                    <input name="password" type="password" value="{{ $_POST['password'] }}">
                                    <span class="text-danger">{{ $errors['password'] }}</span>
                                </li>
                                <li>
                                    <label for="newpassword" class="required">
                                        <span>*</span> Nhập lại mật khẩu:
                                    </label>
                                    <input name="confirmPassword" type="password" value="{{ $_POST['confirmPassword'] }}">
                                    <span class="text-danger">{{ $errors['confirmPassword'] }}</span>
                                </li>


                                <li class="btns">
                                    <input name="submit" type="submit" id="btnSubmit">
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
