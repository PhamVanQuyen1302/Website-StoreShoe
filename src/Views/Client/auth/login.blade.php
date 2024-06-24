@extends('layouts.master')
@section('title')
    Đăng nhập
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-xs-12 wrapbox-heading-page">
            <div class="header-page clearfix">
                <h1>Đăng nhập</h1>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 wrapbox-content-page ">
            <div id="customer-login">
                <div id="login" class="userbox">
                    <div class="accounttype">
                        <h2 class="title"></h2>
                    </div>
                    <div id="customer_login">
                        <form method="post"  action="" enctype="multipart/form-data" class="mt-3">
                            <div class="form-group">
                                <label for="username">Tên Đăng Nhập</label>
                                <input name="username" type="text" class="form-control" id="username"
                                    placeholder="Email">
                                    <span class="text-danger">
                                        {{ $errors['username'] ?? '' }}
                                    </span>
                            </div>

                            <div class="form-group">
                                <label for="password">Mật Khẩu</label>
                                <input name="password" type="password" class="form-control" id="password"
                                    placeholder="Mật khẩu">
                                    <span class="text-danger">
                                        {{ $errors['password'] ?? '' }}
                                    </span>
                            </div>
                            <div class="mt-3 mb-3">
                                <span class="text-danger">
                                    {{ $errors['login'] ?? '' }}
                                    {{ $errors['role'] ?? '' }}
                                </span>
                            </div>
                            <button type="submit" name="submit" id="btnSubmit" class="btn " style="background-color: black ; color:aliceblue; padding: 10px 40px">Đăng nhập</button>
                        </form>
                        <div class="clearfix action_account_custommer">
                            <div class="req_pass">
                                <a href="/user/getpassword" style="display: block">Quên Mật Khẩu?</a>
                                <a href="/auth/register" style="display: block">Đăng ký</a>
                            </div>
                        </div>
                        <div class="divider">
                            <span>Hoặc</span>
                        </div>
                    </div>
                    <div class="login-social">
                        <a href="/user/fbsignin"><i class="fab fa-facebook-f"></i> <span>Đăng nhập bằng tài
                                khoản facebook</span></a>
                    </div>
                    <div class="login-social" style="background: #df4a32;margin-top: 10px">
                        <a href="/user/ggsignin"><i class="fab fa-google-plus-g"></i>
                            <span>Đăng nhập bằng tài khoản gmail</span></a>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection