<section class="third-introduce-products">
      <div class="third-introduce-title">
        <h2>Our Special Products</h2>
      </div>
      <div class="third-introduce-content">
        <div class="third-introduce">
          @if (getIsFeaturedSubCategory()->isNotEmpty())
          @foreach (getIsFeaturedSubCategory() as $subCategory)
          <div>
            <a href="{{url('categories', $subCategory->name)}}">
              <img src="{{ file_exists(public_path('uploads/sub category/thumb/' . $subCategory->image)) ? asset('uploads/sub category/thumb/' . $subCategory->image) : asset('uploads/sub category/thumb/null.png') }}" alt="">
            </a>
            <div>
              <p class="third-introduce-name">{{$subCategory->name}}</p>
            </div>
          </div>
          @endforeach
          @endif
        </div>

      </div>
      </div>
    </section>

    