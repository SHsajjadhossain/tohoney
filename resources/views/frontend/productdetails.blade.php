@extends('layouts.app_frontend')

@section('og_image')

<meta property="og:image" content="{{ asset('uploads/category_photoes') }}/{{ $single_product_info->product_photo }}">

@endsection

@section('content')

 <!-- .breadcumb-area start -->
    <div class="breadcumb-area ptb-100" style="background: #fcf6f6;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>{{ $single_product_info->relationtocategory->category_name }}</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>{{ $single_product_info->product_name }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- single-product-area start-->
    <div class="single-product-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-single-img">
                        <div class="product-active owl-carousel">
                            @foreach (allproduct_thumbnails($single_product_info->id) as $thumbnail)
                            <div class="item">
                                <img src="{{ asset('uploads/product_thumbnails'.'/'.$thumbnail->product_thumbnail_name) }}" alt="Not Found">
                            </div>
                            @endforeach
                        </div>
                        <div class="product-thumbnil-active  owl-carousel">
                            @foreach (allproduct_thumbnails($single_product_info->id) as $thumbnail)
                            <div class="item">
                                <img src="{{ asset('uploads/product_thumbnails'.'/'.$thumbnail->product_thumbnail_name) }}" alt="Not Found">
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="product-single-content">
                        @if (session('stockout'))
                            <div class="alert alert-danger">
                                {{ session('stockout') }}
                            </div>
                        @endif
                        <h3>{{ $single_product_info->product_name }}</h3>
                        <div class="rating-wrap fix">
                            <span class="pull-left">${{ $single_product_info->product_price }}</span>
                            <span class="ratings">
                                <span class="rating-wrap single-product-rating">
                                    <span class="star" style="width: {{ rating_percentage($single_product_info->id) }}%"></span>
                                </span>
                                <span class="rating-num">( {{ how_many_ratings($single_product_info->id) }} )</span>
                            </span>
                        </div>
                        <p>{{ $single_product_info->product_short_description }}</p>
                        <form action="{{ route('addtocart', $single_product_info->id) }}" method="POST">
                            @csrf
                            <ul class="input-style">
                                    <li class="quantity cart-plus-minus">
                                        <input type="text" name="qybutton" value="1" />
                                    </li>
                                    <li><button type="submit">Add to Cart</button></li>
                                </form>

                                @auth
                                    @if ($wishlist_status)
                                        <li>
                                            <a href="{{ route('wishlist.remove', $wishlist_id) }}" class="wishlist">
                                                <i class="fa fa-heart text-danger"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('wishlist.insert', $single_product_info->id) }}" class="wishlist">
                                            <i class="fa fa-heart"></i>
                                            </a>
                                        </li>
                                    @endif
                                @endauth

                                @guest
                                    <li><a href="{{ route('login') }}" class="wishlist"><i class="fa fa-heart"></i></a></li>
                                @endguest

                            </ul>

                        <ul class="cetagory">
                            <li>Category :</li>
                            <li>
                                <a href="{{ route('shoppage') }}">
                                    {{ $single_product_info->relationtocategory->category_name }}
                                </a>
                            </li>
                        </ul>
                        <ul class="cetagory">
                            <li>Available Stock : {{ $single_product_info->product_quantity }}</li>
                        </ul>
                        <ul class="socil-icon">
                            <li>Share :</li>
                            <li>
                                <a href="http://www.facebook.com/sharer.php?u={{ url()->full() }}" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://twitter.com/share?url={{ url()->full() }}&text=Simple Share Buttons&hashtags=simplesharebuttons" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->full() }}" target="_blank">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="https://www.instagram.com/sharer.php?u={{ url()->full() }}" target="_blank">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li> --}}
                            <li>
                                <a href="https://plus.google.com/share?url={{ url()->full() }}" target="_blank">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-60">
                <div class="col-12">
                    <div class="single-product-menu">
                        <ul class="nav">
                            <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                            <li><a data-toggle="tab" href="#tag">Faq</a></li>
                            <li><a data-toggle="tab" href="#review">Review({{ how_many_ratings($single_product_info->id) }})</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="description">
                            <div class="description-wrap">
                                <p>{{ $single_product_info->product_long_description }}</p>
                                {{-- <p>These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. </p> --}}
                            </div>
                        </div>
                        <div class="tab-pane" id="tag">
                            <div class="faq-wrap" id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5><button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">General Inquiries ?</button> </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How To Use ?</button></h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Shipping & Delivery ?</button></h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingfour">
                                        <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">Additional Information ?</button></h5>
                                    </div>
                                    <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingfive">
                                        <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Return Policy ?</button></h5>
                                    </div>
                                    <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="review">
                            <div class="review-wrap">
                                <ul>
                                    @forelse ($reivews as $reivew)
                                        <li class="review-items">
                                            <div class="review-img">
                                                <img width="60px" src="{{ asset('uploads/profile_photoes') }}/{{ $reivew->relationwithuser->profile_photo }}" alt="Not Found">
                                            </div>
                                            <div class="review-content">
                                                <h3><a>{{ $reivew->relationwithuser->name }}</a></h3>
                                                <span>{{ $reivew->created_at->format('d M Y, h:i a') }}</span>
                                                <p>{{ $reivew->review }}</p>
                                                {{-- <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: {{ $reivew->rating * 20 }}%"></span>
                                                    </span>
                                                </span> --}}
                                                <ul class="rating">
                                                    @if ($reivew->rating == 1)
                                                    <li><i class="fa fa-star"></i></li>
                                                    @endif
                                                    @if ($reivew->rating == 2)
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    @endif
                                                    @if ($reivew->rating == 3)
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    @endif
                                                    @if ($reivew->rating == 4)
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    @endif
                                                    @if ($reivew->rating == 5)
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </li>
                                    @empty
                                        <span class="text-danger">No Review To Show</span>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- single-product-area end-->
    <!-- featured-product-area start -->
    <div class="featured-product-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-left">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($related_products as $related_product)
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="featured-product-wrap">
                            <div class="featured-product-img">
                                <img src="{{ asset('uploads/product_photoes'.'/'.$related_product->product_photo) }}" alt="">
                            </div>
                            <div class="featured-product-content">
                                <div class="row">
                                    <div class="col-7">
                                        <h3><a href="{{ route('productdetails', $related_product->product_slug) }}">{{ $related_product->product_name }}</a></h3>
                                        <p>${{ $related_product->product_price }}</p>
                                    </div>
                                    <div class="col-5 text-right">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-danger text-center">
                        <span class="text-danger">No Related Product To Show</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- featured-product-area end -->

@endsection
