<div class="special-prices">
    <div class="container">
        <div class="wrap">
            <div class="heading">
                <h2 class="title" id="special-prices">Special Prices</h2>
            </div>
            <div class="inner-wrapper">
                <div class="dotgrid carouselbox">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @php
                                $chunks = $specialPrices->chunk(4);
                            @endphp

                            @foreach ($chunks as $key => $chunk)
                                <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                                    <div class="special-prices">
                                        <div class="container">
                                            <div class="wrap">
                                                <div class="inner-wrapper">
                                                    <div class="dotgrid carouselbox">
                                                        <div class="wrapper">
                                                            @foreach ($chunk as $product)
                                                                <div class="item">
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
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
                <div class="pagination">
                    <ul>
                        @if ($specialPrices->currentPage() > 1)
                            <li>
                                <a href="{{ $specialPrices->previousPageUrl() }}" class="page-link" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        @endif
                        @for ($i = 1; $i <= $specialPrices->lastPage(); $i++)
                            <li class="{{ ($specialPrices->currentPage() == $i) ? 'active' : '' }}">
                                <a href="{{ $specialPrices->url($i) }}" class="page-link">{{ $i }}</a>
                            </li>
                        @endfor
                        @if ($specialPrices->hasMorePages())
                            <li>
                                <a href="{{ $specialPrices->nextPageUrl() }}" class="page-link" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>            
