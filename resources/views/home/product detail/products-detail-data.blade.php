<div class="product-detail-info">
    <div id="product-id" data-product-id="{{$product->id}}"></div>
    <div class="product-detail-image">
        <div class="detail-image-left">
            <div>
                <img src="{{ asset('uploads/product/products/thumb/' . $product->images->image_1) }}" alt="">
            </div>
            <div>
                <img src="{{ asset('uploads/product/products/thumb/' . $product->images->image_2) }}" alt="">
            </div>
            <div>
                <img src="{{ asset('uploads/product/products/thumb/' . $product->images->image_3) }}" alt="">
            </div>
            <div>
                <img src="{{ asset('uploads/product/products/thumb/' . $product->images->image_4) }}" alt="">
            </div>
        </div>
        <div class="detail-image-right">
            <img src="{{ asset('uploads/product/products/thumb/' . $product->images->image_1) }}" alt="">
        </div>
    </div>
</div>

<div class="product-detail-summary">
    <div class="detail-summary">
        <div class="summary-name">
            <p>{{ isset($variantss[0]) ? $variantss[0]->title : '' }}</p>
            <p class="detail-price">{{ isset($variantss[0]) ? $variantss[0]->price * (1 - $variantss[0]->promotion->value) : '' }}</p>
        </div>        
        <div class="summary-color">
            <div>
                <p>Color</p>
                <p id="color-name" style="font-weight: 600;">{{ isset($variantss[0]->color->name) ? $variantss[0]->color->name : '' }}</p>
            </div>
            <div class="summary-color-item">
                @php
                    $uniqueColors = $variantss->unique('color_id');
                @endphp
                @foreach ($uniqueColors as $uniqueColor)
                    @php
                        $variantWithColor = $variantss->where('color_id', $uniqueColor->color_id)->first();
                    @endphp
                    <div class="block-color">
                        <img src="{{ asset('uploads/product/variantss/thumb/' . $variantWithColor->image) }}"data-product-id="{{ $variantWithColor->product_id }}" data-color-id="{{ $variantWithColor->color_id }}" data-color-name="{{$variantWithColor->color->name}}" data-color-code="{{$variantWithColor->color->code}}" class="color-selector" alt="">
                    </div>
                @endforeach
            </div>            
        </div>
        <div class="summary-size">
            <div> Size <i class="ri-arrow-down-s-line"></i></div>
            <div>
                <p class="product-size-guide">Size Guide</p>
                <div class="product-size" id="size-list">
                   
                </div>
            </div>
        </div>
        <div class="summary-button">
            <button class="js-btn-add-cart">Add to cart</button>
        </div>
        <div>
            <pre>{{$product->description}}
            </pre>
        </div>
    </div>
    <div class="detail-reference">
        <div class="reference-title">
            <div> PRODUCTS DETAILS <i class="ri-arrow-down-s-line"></i> </div>
            <p>
                {{$product->suggestion}}
            </p>
        </div>
        <div class="reference-title">
            <div> CARE <i class="ri-arrow-down-s-line"></i>
        </div>
        <pre>{{$product->care}}</pre>
    </div>
    </div>
</div>