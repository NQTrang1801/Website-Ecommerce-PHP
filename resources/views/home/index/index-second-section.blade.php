<section class="second-introduce-products">
      <div class="second-introduce-title">
        <h2>BIG SALE OF THE MONTH</h2>
        <p>Now or Never</p>
        <a href="{{url('categories','sale')}}">Take a closer look</a>
      </div>
      <div class="second-introduce-content">
        <div class="second-introduce-left">
          <img src="pictures/display-products/female-posting.jpg" alt="">
        </div>
        <div class="second-introduce-right">
          @if ($productsSale->isNotEmpty())
          @foreach ($productsSale as $product)
          <div>
            <a href="">
              <img src="{{ file_exists(public_path('uploads/product/products/thumb/'.$product->images->image_1)) ? asset('uploads/product/products/thumb/'.$product->images->image_1) : asset('uploads/product/products/thumb/null.png') }}" alt="">
            </a>
            <div>
              <p class="second-introduce-name">{{$product->title}}</p>
              <p class="second-introduce-price"><del>{{ number_format($product->price, 0, ',', '.') }}</del><del>VND</del> <span>{{ number_format($product->price * $product->promotion->value, 0, ',', '.') }}</span> VND</p>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </section>