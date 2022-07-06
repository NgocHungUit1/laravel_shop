<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---------Seo--------->



    <!--//-------Seo--------->
    <title></title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{('public/frontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

</head>
<!--/head-->

<body>

    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> 0932023992</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> webextrasite.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="{{('public/frontend/images/home/logo.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">

                                <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
                                <?php
                                $customer_id = Session::get('customer_id');
                                $shipping_id = Session::get('shipping_id');
                                if ($customer_id != null && $shipping_id == null) {
                                ?>
                                    <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>

                                <?php
                                } elseif ($customer_id != null && $shipping_id != null) {
                                ?>
                                    <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                } else {
                                ?>
                                    <li><a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                }
                                ?>


                                <li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                @php
                                $customer_id = Session::get('customer_id');
                                if ($customer_id != null) {
                               @endphp
                                    <li><a href="{{URL::to('/history')}}"><i class="fa fa-bell"></i> Lịch sử mua hàng</a></li>

                           
                               @php
                                }

                               @endphp
                               
                               <?php
                                $customer_id = Session::get('customer_id');
                                if ($customer_id != null) {
                                ?>
                                    <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>

                                <?php
                                } else {
                                ?>
                                    <li><a href="{{URL::to('/dang-nhap')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <?php
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/')}}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">

                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>

                                </li>
                                <li><a href="{{URL::to('/gio-hang')}}">Giỏ hàng</a></li>
                                <li><a href="{{URL::to('/lien-he')}}">Liên hệ</a></li>
                                <li><a href="{{URL::to('/video-home')}}">Video</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">

                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <!-- <div class="addthis_inline_share_toolbox"></div> -->

                            <form autocomplete="off" class="form-inline my-2 my-lg-0" action="{{URL::to('tim-kiemm')}}" method="POST">
                                @csrf
                                <input class="form-control mr-sm-2" id="keywords" type="search" name="tukhoa" placeholder="Nhập thông tin cần tìm kiếm ...." aria-label="Search">
                                <div id="search_ajax"></div>
                                <button class="btn my-2 my-sm-0" type="submit">Search</button>








                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/header-bottom-->
    </header>
    <!--/header-->


    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        <style type="text/css">
                            img.img.img-responsive.img-slider {
                                height: 350px;
                            }
                        </style>
                        <div class="carousel-inner">

                            @php
                            $i = 0;
                            @endphp
                            @foreach($slider as $key => $slide)
                            @php
                            $i++;
                            @endphp

                            <div class="item {{$i==1 ? 'active' : '' }}">

                                <div class="col-sm-12">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                    <img alt="{{$slide->slider_desc}}" src="{{asset('public/uploads/slider/'.$slide->slider_image)}}" height="100" width="500%" class="img img-responsive img-slider">

                                </div>
                            </div>
                            @endforeach


                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--/slider-->


    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <style type="text/css">
                            .bigon {
                                border: 2px solid #FE980F;
                                margin-bottom: 20px;
                                padding-bottom: 5px;
                                padding-top: 15px;



                            }

                            .panel {
                                margin: 10px;
                                margin-bottom: 10px;
                                margin-top: 10px;
                            }
                        </style>

                        <div class="bigon" id="accordian">
                            <h2>Danh mục sản phẩm</h2>

                            <!--category-productsr-->
                            @foreach($cate as $key => $value)

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{URL::to('/danh-muc/'.$value->category_id)}}">{{$value->category_name}}</a></h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!--/category-products-->

                        <div class="bigon">
                            <!--brands_products-->
                            <h2>Thương hiệu sản phẩm</h2>


                            @foreach($brand as $key => $brand)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{URL::to('/thuong-hieu/'.$brand->brand_id)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></h4>
                                </div>
                            </div>

                            @endforeach


                        </div>
                        <!--/brands_products-->
                        <h2>Sản Phẩm Yêu Thích</h2>
                        <div class="bigon">

                            <div id="row_wishlist" class="row"></div>


                        </div>



                    </div>
                </div>

                <div class="col-sm-9 padding-right">

                    @yield('content')

                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <style type="text/css">
                        img.img.img-responsive.img-video {
                            height: 150px;
                            width: 150%;
                        }
                    </style>
                    <div class="col-sm-12">

                        @foreach($all_video as $key => $video)
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">

                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <form>
                                            @csrf


                                            <a href="">
                                                <img class="img img-responsive img-video" src="{{asset('public/uploads/video/'.$video->video_image)}}" alt="" />
                                                <h2>{{$video->video_title}}</h2>
                                                <p>{{$video->video_desc}}</p>


                                            </a>

                                            <button type="button" class="btn btn-primary watch-video" data-toggle="modal" data-target="#modal_video" id="{{$video->video_id}}">Xem bài viết</button>
                                        </form>

                                    </div>

                                </div>

                            </div>
                        </div>
                        @endforeach

                        <div class="modal fade" id="modal_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="video_title">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="video_link">

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="images/home/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer style="margin-left:300px" class="main-footer">
            <div class="main-footer--bottom">
                <div>
                    <div class="">
                        <div class="row">

                            <div style="padding-left:0" class="col-xs-12 col-sm-6 col-md-3 col-lg">
                                <div class="footer-col footer-block">



                                    <h4 class="footer-title lang" keylanguage="he_thong_cua_hang_hades">HỆ THỐNG CỬA HÀNG HADES</h4>
                                    <div class="footer-content">

                                        <p>Hades FLAGSHIP STORE: 69 QUANG TRUNG STREET, GO VAP DISTRICT, HOCHIMINH.
                                            <br>
                                            Store 2: 26 LY TU TRONG STREET, DISTRICT 1, HOCHIMINH (THE NEW PLAYROUND).
                                            <br>
                                            Store 3: 350 DIEN BIEN PHU STREET, WARD 7, BINH THANH DISTRICT, HOCHIMINH (G-TOWN).
                                            <br>
                                            Store 4: 4 PHAM NGU LAO STREET, DISTRICT 1, HOCHIMINH.
                                            <br>
                                            Store 5: 136 NGUYEN HONG DAO STREET, TAN BINH DISTRICT, HOCHIMINH.
                                            <br>
                                            Store 6: VINCOM SHOPHOUSE, BIEN HOA.
                                            <br>
                                            Store 7: FLOOR 7 - BLOCK B2 - VINCOM BA TRIEU, HANOI.
                                        </p>


                                    </div>
                                </div>
                            </div>


                            <div style="padding-left:0" class="col-xs-12 col-sm-6 col-md-3 col-lg">
                                <div class="footer-col footer-block">



                                    <h4 class="footer-title lang" keylanguage="he_thong_cua_hang_hades">Chinhs sach</h4>
                                    <div class="footer-content">

                                        <p>Hades FLAGSHIP STORE: 69 QUANG TRUNG STREET, GO VAP DISTRICT, HOCHIMINH.
                                            Chính sách sử dụng website
                                            Phương thức thanh toán
                                            Chính sách đổi trả
                                            Chính sách giao nhận - vận chuyển
                                            Điều khoản dịch vụ
                                            Hướng dẫn mua hàng
                                            Chính sách bảo mật
                                        </p>


                                    </div>
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg">
                                <div class="footer-col footer-block">


                                    <h4 class="footer-title lang" keylanguage="thong_tin_lien_he">THÔNG TIN LIÊN HỆ</h4>
                                    <div class="footer-content toggle-footer">




                                        <ul>
                                            <li>
                                                <span class="lang" keylanguage="cong_ty_tnhh_hadesdia_chi_45_phan_chu_trinh_p_ben_thanh_quan_1_tp_ho_chi_minh">CÔNG TY TNHH HADES Địa chỉ: 45 Phan Chu Trinh, P. Bến Thành, Quận 1, TP. Hồ Chí Minh</span>
                                            </li>
                                            <li><span class="lang" keylanguage="so_cskh02873011021_10h_18h">SỐ CSKH: 02873011021 (10h -18h)</span></li>
                                            <li><span class="lang" keylanguage="ngay_cap20_07_2020">Ngày cấp: 20/07/2020</span></li>
                                            <li><span class="lang" keylanguage="tuyen_dunghr_hades_vn">Tuyển dụng: hr@hades.vn</span></li>


                                            <li><span class="lang" keylanguage="websitehades_vn">Website: hades.vn</span></li>


                                            <li><span class="lang" keylanguage="lien_he_cskhsupport_hades_vn">Liên hệ CSKH: support@hades.vn</span></li>


                                            <li><span class="lang" keylanguage="for_businesscontact_hades_vn">For business: contact@hades.vn</span></li>


                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <!---ADDED--->
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg">

                                <div class="footer-col footer-block">

                                    <div class="footer-content">

                                        <g>
                                            <g>
                                                <path d="M448,0H64C28.704,0,0,28.704,0,64v384c0,35.296,28.704,64,64,64h192V336h-64v-80h64v-64c0-53.024,42.976-96,96-96h64v80
											h-32c-17.664,0-32-1.664-32,16v64h80l-32,80h-48v176h96c35.296,0,64-28.704,64-64V64C512,28.704,483.296,0,448,0z"></path>
                                            </g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        </svg>






                                    </div>
                                </div>
                            </div>
                            <!---ADDED--->


                        </div>
                    </div>
                </div>
            </div>

        </footer>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>

    </footer>
    <!--/Footer-->



    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>


    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/prettify.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=2339123679735877&autoLogAppEvents=1"></script>
    <script type="text/javascript">
        function view() {
            if (localStorage.getItem('data') != null) {

                var data = JSON.parse(localStorage.getItem('data'));

                data.reverse();
                document.getElementById('row_wishlist').style.overflow = 'scroll';
                document.getElementById('row_wishlist').style.height = '200px';
                for (i = 0; i < data.length; i++) {

                    var name = data[i].name;
                    var image = data[i].image;
                    var price = data[i].price;
                    var url = data[i].url;

                    $('#row_wishlist').append(`

                  <div class="row " style="margin:10px 0">
                    <div class="col-md-4"><img src="` + image + `" width="100%"></div>

                    <div class="col-md-8 infor_wishlist">
                    <p>` + name + `</p>     <p style="color:#FE980F">` + price + `</p>
                      <a href="` + url + `">Đặt hàng

                      </a>
                    </div>

                </div>
                 `);
                }

            }
        }
        view();

        function add_wishlist(clicked_id) {

            var id = clicked_id;
            var name = document.getElementById('wishlist_productname' + id).value;
            var image = document.getElementById('wishlist_productimage' + id).src;
            var url = document.getElementById('wishlist_producturl' + id).href;
            var price = document.getElementById('wishlist_productprice' + id).value;

            var newItem = {
                'id': id,
                'name': name,
                'image': image,
                'url': url,
                'price': price
            }
            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]');
            }
            var old_data = JSON.parse(localStorage.getItem('data'));
            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;
            })
            if (matches.length) {
                alert('Sản phẩm đã có trong danh sách yêu thích');
            } else {

                old_data.push(newItem);





                $('#row_wishlist').append(`

              <div class="row " style="margin:10px 0">
                  <div class="col-md-4"><img src="` + newItem.image + `" width="100%"></div>

                  <div class="col-md-7 infor_wishlist">
                  <p>` + newItem.name + `</p>     <p style="color:#FE980F">` + newItem.price + `</p>
                         <a href="` + newItem.url + `">Đặt hàng

    </a>
  </div>

</div>
`);


                localStorage.setItem('data', JSON.stringify(old_data));
                alert('Đã thêm vào danh sách sản phẩm yêu thích.');

            }

            localStorage.setItem('data', JSON.stringify(old_data));




        }
    </script>
    <script type="text/javascript">
        $('.quickview').click(function() {

            var product_id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/quickview')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.send_order').click(function() {
                swal({
                        title: "Xác nhận đơn hàng",
                        text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Cảm ơn, Mua hàng",

                        cancelButtonText: "Đóng,chưa mua",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            var shipping_email = $('.shipping_email').val();
                            var shipping_name = $('.shipping_name').val();
                            var shipping_address = $('.shipping_address').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_notes = $('.shipping_notes').val();
                            var shipping_method = $('.payment_select').val();
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var _token = $('input[name="_token"]').val();

                            $.ajax({
                                url: "{{url('/confirm-order')}}",
                                method: 'POST',
                                data: {
                                    shipping_email: shipping_email,
                                    shipping_name: shipping_name,
                                    shipping_address: shipping_address,
                                    shipping_phone: shipping_phone,
                                    shipping_notes: shipping_notes,
                                    _token: _token,
                                    order_fee: order_fee,
                                    order_coupon: order_coupon,
                                    shipping_method: shipping_method
                                },
                                success: function() {
                                    swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                                }
                            });

                            window.setTimeout(function() {
                                location.reload();
                            }, 3000);

                        } else {
                            swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");

                        }

                    });


            });
        });
    </script>
    <!-- mua ngay quick view -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart').click(function() {

                var id = $(this).data('id_product');
                // alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                } else {

                    $.ajax({
                        url: "{{url('/add-cart-ajax')}}",
                        method: 'POST',
                        data: {
                            cart_product_id: cart_product_id,
                            cart_product_name: cart_product_name,
                            cart_product_image: cart_product_image,
                            cart_product_price: cart_product_price,
                            cart_product_qty: cart_product_qty,
                            _token: _token,
                            cart_product_quantity: cart_product_quantity
                        },
                        success: function() {

                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio-hang')}}";
                                });

                        }

                    });
                }


            });
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '.add-to-cart-quickview', function() {


            var id = $(this).data('id_product');
            // alert(id);
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();
            if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
            } else {

                $.ajax({
                    url: "{{url('/add-cart-ajax')}}",
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token,
                        cart_product_quantity: cart_product_quantity
                    },
                    beforeSend: function() {
                        $("#beforesend_quickview").html("đang thêm sản phẩm vào giỏ hàng...");

                    },
                    success: function() {
                        $("#beforesend_quickview").html("Đã sản phẩm vào giỏ hàng...");


                    }

                });
            }


        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: "{{url('/select-delivery-home')}}",
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.calculate_delivery').click(function() {
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == '') {
                    alert('Làm ơn chọn để tính phí vận chuyển');
                } else {
                    $.ajax({
                        url: "{{url('/calculate-fee')}}",
                        method: 'POST',
                        data: {
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token
                        },
                        success: function() {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('#keywords').keyup(function() {
            var keywords = $(this).val();

            if (keywords != '') {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{url('/tim-kiem')}}",
                    method: "POST",
                    data: {
                        keywords: keywords,
                        _token: _token
                    },
                    success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });

            } else {

                $('#search_ajax').fadeOut();
            }
        });

        $(document).on('click', '.li_timkiem_ajax', function() {
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '.watch-video', function() {
            var video_id = $(this).attr('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/watch-video')}}",
                method: 'POST',
                dataType: "JSON",
                data: {
                    video_id: video_id,
                    _token: _token
                },
                success: function(data) {
                    $('#video_title').html(data.video_title);
                    $('#video_link').html(data.video_link);
                }
            });




        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 2,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sort').on('change', function() {

                var url = $(this).val();

                if (url) {
                    windown.location = url;
                }
                return false;
            });

        });
    </script>


</body>

</html>