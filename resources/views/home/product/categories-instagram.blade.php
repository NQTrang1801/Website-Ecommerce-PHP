<div class="formIG">
    <div class="container">
        <div class="wrap">
            <div class="heading">
                <h2 class="title">Popular Instagram Photos</h2>
            </div>
            <div class="dotgrid scrollto">
                <div class="wrapper">
                    @if ($productFeatureds->isNotEmpty())
                    @foreach ($productFeatureds as $product)
                    <div class="item">
                        <div class="dot-image">
                            <a href=""></a>
                            <div class="thumbnail">
                                <img src="{{ file_exists(public_path('uploads/product/products/thumb/'.$product->images->image_1)) ? asset('uploads/product/products/thumb/'.$product->images->image_1) : asset('uploads/product/products/thumb/null.png') }}" alt="">
                            </div>
                            <div class="actions">
                                <i class="ri-instagram-line">

                                </i>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>