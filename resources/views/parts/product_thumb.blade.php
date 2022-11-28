<li class="col-xl-3 col-lg-4 col-sm-6 col-12">
    <div class="product-wrap">
        <div class="product-img">
            <span>Sale</span>
            <img src="{{ asset('uploads/product_photoes').'/'.$product->product_photo }}" alt="Not Found">
            <div class="product-icon flex-style">
                <ul>
                    <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                    <li>
                        <a href="wishlist.html">
                            {{-- @if (wishlistcheck($product->id))
                                <i class="fa fa-heart text-danger" style="background: #0000"></i>
                            @else
                                <i class="fa fa-heart"></i>
                            @endif --}}
                            <i class="fa {{ wishlistcheck($product->id) ? 'fa-heart text-danger' : 'fa-heart' }}"></i>
                        </a>
                    </li>
                    <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="{{ route('productdetails', $product->product_slug) }}">{{ $product->product_name }}</a></h3>
            <p class="pull-left">${{ $product->product_price }}</p>
            <ul class="pull-right d-flex">
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star-half-o"></i></li>
            </ul>
            <p style="margin-right: auto; margin-top: 35px;">Vendor : {{ App\Models\User::find($product->user_id)->name }} </p>
        </div>
    </div>
</li>
