@extends('layouts.master')
@section('title')
    Liên hệ
@endsection
@section('content')
<body class="tp_background tp_text_color">
    <script defer type="text/javascript"
        src="https://web.nvnstatic.net/js/jquery/jquery.validationEngine.js?v=2"></script>
    <script defer type="text/javascript"
        src="https://web.nvnstatic.net/js/jquery/jquery.validationEngine-vi.js?v=2"></script>
    <script defer type="text/javascript" src="https://web.nvnstatic.net/tp/T0320/js/user.js?v=2"></script>
    <link rel="stylesheet" href="https://web.nvnstatic.net/css/validationEngine.jquery.css?v=2" type="text/css">
    <link rel="stylesheet" href="https://web.nvnstatic.net/tp/T0320/css/contact.css?v=2" type="text/css">
    <section class="bread_crumb py-4 mb-4 ">
        <div class="container">
            <ul class="breadcrumb mt-4">
                <li class="home">
                    <a href="/"><span itemprop="title">Trang chủ</span></a>
                </li>
                <li><strong>Liên hệ</strong></li>
            </ul>
        </div>
    </section>
    <div class="container container-fix-hd contact margin-bottom-30">
        <div class="box-heading hidden relative">
            <h1 class="title-head">Liên hệ</h1>
        </div>
        <h2 class="title-head tp_title"><span> Gửi tin nhắn cho chúng tôi</span></h2>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <div id="login">
                            <form accept-charset="UTF-8" action="" class="validate" id="contact" method="post">
                                <div id="emtry_contact" class="form-signup form_contact clearfix">
                                    <div class="row row-8Gutter">
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <input type="text" placeholder="Họ tên*" name="name" id="name"
                                                    class="validate[required] form-control  form-control-lg"
                                                    required="">
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <input type="email" placeholder="Email*" name="email" id="email"
                                                    class="validate[required,custom[email]] form-control form-control-lg"
                                                    required="">
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <input type="tel" placeholder="Điện thoại*" name="mobile"
                                                    class="validate[required,custom[phone]] fixnumber form-control form-control-lg"
                                                    required="">
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <input type="text" placeholder="Địa chỉ*" name="address"
                                                    class="validate[required] form-control form-control-lg" required="">
                                            </fieldset>
                                        </div>
                                    </div>
                                    <fieldset class="form-group">
                                        <textarea placeholder="Nhập nội dung*" name="content"
                                            class="validate[required]] form-control form-control-lg" rows="6"
                                            required=""></textarea>
                                    </fieldset>
                                    <div>
                                        <button type="summit" class="btn btn-primary tp_button">Gửi liên hệ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-box-info clearfix margin-bottom-30">
                            <div class="item">
                                <div>
                                    <i class="fas fa-map-marker"></i>
                                    <div class="info">
                                        <label>Địa chỉ</label>
                                        102 Thái Thịnh, Trung Liệt, Đống Đa, Hà Nội
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-phone"></i>
                                    <div class="info">
                                        <label>Điện thoại</label>
                                        <a href="tel:">
                                        </a>
                                        <p>Thứ 2 - Chủ nhật: 9:00 - 18:00</p>
                                    </div>
                                </div>
                                <div><i class="fas fa-envelope"></i>
                                    <div class="info">
                                        <label>Email</label>
                                        <a href="mailto:contact@nhanh.vn">
                                            contact@nhanh.vn </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="box-maps margin-bottom-30">
                    <div class="iFrameMap">
                        <div class="google-map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.592638403604!2d105.81799141434827!3d21.00896029383121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac828a8d097f%3A0x7149275aa4ecd1df!2zTmhhbmgudm4gLSBQaOG6p24gbeG7gW0gcXXhuqNuIGzDvSBiw6FuIGjDoG5n!5e0!3m2!1svi!2s!4v1532678889771"
                                width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <style>
        .google-map {
            width: 100%;
        }

        .google-map iframe {
            width: 100% !important;
            max-height: 450px !important;
        }

        .google-map .map {
            width: 100%;
            height: 450px;
            background: #dedede
        }

        button[type="summit"] {
            padding: 0 40px;
            text-transform: inherit;
        }

        form #showErrorContact {
            border: 1px dashed #F04E23;
            margin-bottom: 20px;
            color: #F04E23;
            padding: 2px 5px;
            text-align: center;
        }

        form #showSuccessContact {
            border: 1px dashed #008000;
            margin-bottom: 20px;
            color: #008000;
            padding: 2px 5px;
            text-align: center;
        }
    </style>
    <div style="display: none;">
        <div id="dMsg"></div>
    </div>
    <div id="quickview-cart" class="modal fade" role="dialog">
        <div class="quickview-content-cart">
            <div id="quickview-cart-desktop" class="clearfix"></div>
        </div>
    </div>
    <div id="guide-size" class="modal fade" role="dialog">
        <div class="modal-content clearfix"></div>
    </div>
    <div id="modalShow" class="modal fade in" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center"><span class="title-modal">Đang xử lý</span>
                    <div class="desc-modal"><img src="https://web.nvnstatic.net/tp/T0320/img/loading.gif?3?v=3"
                            alt="loading" /></div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalAbandoned" class="modal fade right" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        data-backdrop="true" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
            <!--Content-->
            <div class="modal-content"></div>
            <!--/.Content-->
        </div>
    </div>
    <input type="hidden" class="checkCookies" value=''>
    <div id="dialogMessage"></div>



    <input type="hidden" class="fanpageId" value="">
    <meta name="google-site-verification" content="ueN8a6L-rHAbBgu2lamINIYDu73uSC2eUs8YTWdlYGo" />
    <Style>
        .bannercategory .box-sport-content img {
            width: 100%;
            -webkit-transition: all 10s;
            transition: all 4s;
        }
    </style>
    <style>
        .main-whynote {
            background: #f2f2f2;
            padding: 100px 0 30px;
            position: relative;
            transition: all 4s;
        }
    </style>
    <style>
        img {
            max-width: 100%;
            object-fit: scale-down;
            transition: all 4s;
        }

        .main-whynote .box-why-note .title-why h2 a {
            color: #de0000;
            transition: all 4s;
        }
    </style>
    <style>
        #nav-menu .main-nav-menu .menu__list--top>li:hover>a {
            background: #de101d;
            color: #fff;
            opacity: 70%;
        }

        #nav-menu .main-nav-menu .menu__list--top>li>a {
            padding: 10px;
            border-radius: 10px;
            font-size: 18px;
            color: #000000;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-transition: all .3s;
            transition: all .3s;
        }
    </style>
    <style>
        .bannercategory {
            background: #f2f2f2;
            padding-bottom: 40px;
            padding-top: 6rem;
        }
    </style>
    <style>
        .bannercategory .box-sport-content img {
            border-radius: 10px;
            width: 100%;
            -webkit-transition: all 10s;
            transition: all 4s;
        }

        .bannercategory .box-sport-content .more {
            border-radius: 5px;
            position: absolute;
            bottom: 25px;
            left: 50%;
            -webkit-transform: translate(-50%);
            transform: translate(-50%);
            width: 170px;
            height: 40px;
            display: block;
            line-height: 40px;
            text-align: center;
            background: #fff;
            color: #000;
            font-weight: 700;
            margin: 0 auto;
            -webkit-transition: all .5s;
            transition: all .5s;
        }
    </style><input type="hidden" id="bussinessId" value="97757"><input type="hidden" value="" id="uctk"
        name="uctk" /><input type="hidden" id="clienIp" value="113.190.83.234">
</body>
@endsection