{{-- @if ($category && $category->getSubCategories->isNotEmpty())
    @php
        $count = 1; 
        $typeNum = 1;  
    @endphp
    @foreach ($category->getSubCategories as $subCategory)
        @if ($subCategory->showHome == "Yes")
            <div class="category-view-{{$count}} type-{{$typeNum}}" id="category-view-{{$typeNum}}">
                <div class="container">
                    <div class="wrap">
                        <div class="heading">
                            <h2 class="title" id="category-{{$typeNum}}">{{$subCategory->name}}</h2>
                        </div>
                        <div class="inner-wrapper">
                            <div class="dotgrid">
                                <div class="wrapper">
                                    @foreach ($products as $product)
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
                                                        @if ($product->promotion && $product->promotion->value !== null)
                                                            <div class="label"><span>-{{ $product->promotion->value * 100 }}%</span></div>
                                                        @endif
                                            </div>
                                            <div class="dot-info">
                                                <h2 class="dot-title"><a href="">{{ $product->title }}</a></h2>
                                                <div class="product-price">
                                                        @if ($product->promotion && $product->promotion->value !== null)
                                                            <span class="before">{{ $product->price }} VND</span>
                                                            <span class="current">{{ $product->price * (1 - $product->promotion->value) }} VND</span>
                                                        @else
                                                            <span class="current">{{ $product->price }} VND</span>
                                                        @endif
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
            @php
                $typeNum++;
                if ($count == 2)
                    $count--;
                else {
                    $count++;
                }   
            @endphp
        @endif
    @endforeach
@else
    <!-- Handle case when there are no categories or subcategories -->
    <p>No categories or subcategories found.</p>
@endif --}}
@if ($category && $category->getSubCategories->isNotEmpty())
    @php
        $count = 1; 
        $typeNum = 1;  
    @endphp

    @foreach ($category->getSubCategories as $subCategory)
        @if ($subCategory->showHome == "Yes")
            <div class="category-view-{{$count}} type-{{$typeNum}}" id="category-view-{{$typeNum}}">
                <div class="container">
                    <div class="wrap">
                        <div class="heading">
                            <h2 class="title" id="category-{{$typeNum}}">{{$subCategory->name}}</h2>
                        </div>
                        <div class="inner-wrapper">
                            <div class="dotgrid">
                                <div class="wrapper">
                                    @foreach ($subCategory->products as $product)
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
                                                            @if ($product->promotion && $product->promotion->value !== null)
                                                                <div class="label"><span>-{{ $product->promotion->value * 100 }}%</span></div>
                                                            @endif
                                                </div>
                                                <div class="dot-info">
                                                    <h2 class="dot-title"><a href="">{{ $product->title }}</a></h2>
                                                    <div class="product-price">
                                                            @if ($product->promotion && $product->promotion->value !== null)
                                                                <span class="before">{{ $product->price }} VND</span>
                                                                <span class="current">{{ $product->price * (1 - $product->promotion->value) }} VND</span>
                                                            @else
                                                                <span class="current">{{ $product->price }} VND</span>
                                                            @endif
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
            @php
                $typeNum++;
                if ($count == 2)
                    $count--;
                else {
                    $count++;
                }   
            @endphp
        @endif
    @endforeach
@else
    <!-- Handle case when there are no categories or subcategories -->
    <p>No categories or subcategories found.</p>
@endif
