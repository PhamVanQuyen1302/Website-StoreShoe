@extends('layouts.master')
@section('title')
    Đăng ký
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-xs-12 wrapbox-heading-page">
            <div class="header-page clearfix">
                <h1>Đăng ký</h1>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 wrapbox-content-page ">
            <div class="userbox">
                <div id="create_customer">
                    <form method="post" action="" enctype="multipart/form-data" class="mt-3">

                        <div class="form-group">
                            <label for="fullName">Họ và tên</label>
                            <input name="name" type="text" class="form-control" value="{{ $_POST['name'] }}" id="fullName"
                                placeholder="Họ và tên" >
                            <span class="text-danger">
                                {{ $errors['name'] ?? '' }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" value="{{ $_POST['email'] }}" id="email" placeholder="Email"
                                >
                            <span class="text-danger">
                                    {{ $errors['email'] ?? '' }}
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input name="username" type="text" class="form-control" value="{{ $_POST['username'] }}" id="username" placeholder="Username"
                                >
                            <span class="text-danger">
                                {{ $errors['username'] ?? '' }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input name="password" type="password" class="form-control" value="{{ $_POST['password'] }}" id="password"
                                placeholder="Mật khẩu"  minlength="6">
                            <span class="text-danger">
                                {{ $errors['password'] ?? '' }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="mobile">Điện thoại</label>
                            <input name="tel" type="text" class="form-control" value="{{ $_POST['tel'] }}" id="mobile"
                                placeholder="Điện thoại" >
                            <span class="text-danger">
                                {{ $errors['tel'] ?? '' }}

                            </span>
                        </div>

                        <button type="submit" name="submit" id="btnSubmit" class="btn" style="background-color: black ; color:aliceblue; padding: 10px 40px">Đăng ký</button>
                    </form>
                </div>
                <div class="clearfix req_pass mt-2">
                    <a class="come-back" href="/"><i class="fal fa-long-arrow-left"></i> Quay lại trang
                        chủ</a>
                </div>
            </div>
        </div>

    </div>

    </div>
@endsection
