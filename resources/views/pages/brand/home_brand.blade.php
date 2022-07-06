@extends('layout')
@section('content')
<div class="features_items">
    <!--features_items-->
    <style type="text/css">
                                .quickview {
                                    background: #f5f5ed;
                                    border: 0 none;
                                    border-radius: 0;
                                    color: #696763;
                                    font-family: 'Roboto', sans-serif;
                                    font-size: 15px;
                                    margin-bottom: 25px;
                                }
                            </style>



    @foreach($bigon as $key => $product)

    <div class="col-sm-4">
        <div class="product-image-wrapper">

            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        @csrf
                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                            <input type="hidden" id="wishlist_productname{{$product->product_id}}" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                            <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                            <input type="hidden"  id="wishlist_productprice{{$product->product_id}}"  value="{{number_format($product->product_price,0,',',',')}}VNĐ" class="cart_product_price_{{$product->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">


                            <a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/chi-tiet/'.$product->product_id)}}">
                                <img id="wishlist_productimage{{$product->product_id}}" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                <h2>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
                                <p>{{$product->product_name}}</p>


                            </a>
                        <input type="button" value="Add to cart" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                        <input type="button" value="Quick View" class="btn btn-default quickview" data-toggle="modal" data-target="#xemnhanh" data-id_product="{{$product->product_id}}" name="add-to-cart">
                    </form>

                </div>

            </div>

            <div class="em-element-display-hover bottom">
                    <ul class="nav nav-pills nav-justified">
                        <style type="text/css">
                            ul.nav.nav-pills.nav-justified li {
                                text-align: center;
                                font-size: 13px;
                            }
                          
                            ul.nav.nav-pills.nav-justified i {
                                color:#b3afa8;                               

                            }
                            .btn_wishlist span:hover{
                                color: #FE980f;

                            }
                            .btn_wishlist:focus{
                                border:none;
                                outline:none;
                            }


                        </style>
                        <li>
                            
                            <button class="btn btn-danger btn_wishlist" id="{{$product->product_id}}" onclick="add_wishlist(this.id);"><i class="fa fa-heart" aria-hidden="true"></i> Add Wishlist</button>
                        </li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    </ul>
                </div>
        </div>

    </div>
    </a>
    @endforeach
</div>
<!--features_items-->
<ul class="pagination pagination-sm m-t-none m-b-none">

</ul>
<div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title product_quickview_title" id="product_quickview_title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <style type="text/css">
                    span#product_quickview_content img {
                        width: 100%;
                    }
                </style>

                <style type="text/css">
                    h5.modal-title.product_quickview_title {
                        text-align: center;
                        font-size: 25px;
                        color: brown;

                    }

                    p.quickview {
                        font-size: 14px;
                        color: brown;

                    }

                    span#product_quickview_content img {
                        width: 50%;
                    }

                    @media screen and (min-width:768px) {
                        .modal-dialog {
                            width: 700px;

                        }

                        .modal-sm {
                            width: 350px;
                        }
                    }

                    @media screen and (min-width:992px) {
                        .modal-lg {
                            width: 1200px;
                        }
                    }
                </style>
                <div class="row">
                    <div class="col-md-5">
                        <span id="product_quickview_image"></span>
                        <span id="product_quickview_gallery"></span>
                    </div>
                    <form>
                        @csrf
                        <div id="product_quickview_value"></div>
                        <div class="col-md-7">
                            <h2 class="quickview">
                                <span id="product_quickview_title">


                                </span>
                            </h2>
                            <p>
                                Mã ID:<span id="product_quickview_id">

                                </span>
                            </p>
                            <span>
                                <h2 style="color:#FE980f">Giá sản phẩm :
                                    <span id="product_quickview_price">


                                    </span>
                                </h2>
                                <br />
                                <label>Số lượng:</label>
                                <input name="qty" type="number" min="1" class="cart_product_qty_" value="1" />

                            </span> <br />
                            <p class="quickview">Mô tả sản phẩm</p>
                            <fieldset>
                                <span style="width:100%" id="product_quickview_desc"></span>
                                <span style="width:100%" id="product_quickview_content"></span>
                            </fieldset>
                            <input type="button" value="Buy Now" class="btn btn-primary btn-sm add-to-cart-quickview" data-id_product="{{$product->product_id}}" name="add-to-cart">

                            <div id="beforesend_quickview"></div>
                        </div>
                    </form>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Đóng

                </button>
                <button type="button" class="btn btn-default">
                    Mua sản phẩm

                </button>

            </div>
        </div>
    </div>
</div>

<!--/recommended_items-->
@endsection