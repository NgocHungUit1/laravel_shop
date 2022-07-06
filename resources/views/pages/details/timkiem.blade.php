@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Kết quả tìm kiếm</h2>
                       
    @foreach($search_product as $key => $product)
    <a href="{{URL::to('/chi-tiet/'.$product->product_id)}}">
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
                            <input type="hidden"  id="wishlist_productprice{{$product->product_id}}"   value="{{$product->product_price}}.VNĐ'" class="cart_product_price_{{$product->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">


                            <a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/chi-tiet/'.$product->product_id)}}">
                                <img id="wishlist_productimage{{$product->product_id}}" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                <h2>{{number_format($product->product_price,0,',','.').' '.'VNĐ'}}</h2>
                                <p>{{$product->product_name}}</p>


                            </a>
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
        <!--/recommended_items-->
@endsection