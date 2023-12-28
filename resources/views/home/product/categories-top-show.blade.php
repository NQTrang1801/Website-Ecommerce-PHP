<div class="special-prices">
    <div class="container">
        <div class="wrap">
            <div class="heading">
                <h2 class="title" id="special-prices">Special Prices</h2>
            </div>
            <div class="inner-wrapper">
                <div class="dotgrid carouselbox">
                    <div class="wrapper">
                        @if ($specialPrices->isNotEmpty())
                            @foreach ($specialPrices as $product)
                                <div class="item">
                                    <div class="dot-image">
                                        <a href="" class="product-permalink"></a>
                                        <div class="thumbnail">
                                            <img src="{{ asset('uploads/product/products/thumb/' . $product->images->image_1) }}" alt="">
                                        </div>
                                        <div class="thumbnail hover">
                                            <img src="{{ asset('uploads/product/products/thumb/' . $product->images->image_2) }}" alt="">
                                        </div>
                                        <div class="actions">
                                            <div><i class="ri-heart-line"></i></div>
                                            <div class="js-btn-add-cart" data-product-id="{{ $product->id }}"><i class="ri-shopping-cart-line"></i></div>
                                            <a href=""><i class="ri-eye-line"></i></a>
                                        </div>
                                        <div class="label"><span>-{{ $product->promotion->value * 100 }}%</span></div>
                                    </div>
                                    <div class="dot-info">
                                        <h2 class="dot-title"><a href="">{{ $product->title }}</a></h2>
                                        <div class="product-price">
                                            <span class="before">{{ $product->price }} VND</span>
                                            <span class="current">{{ $product->price * (1 - $product->promotion->value) }} VND</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No special prices available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="see-more">
        <button>See more</button>
    </div>
</div>
