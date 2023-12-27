<header>
    <div class="private-header">
        <div class="private-header-left-section">
            <div class="header-menu js-menu-btn">
                <i class="ri-menu-line"></i>
                <span>Menu</span>
            </div>
            <div class="header-search">
                <i class="ri-search-line"></i>
                <span>Search</span>
            </div>
        </div>

        <div class="private-header-middle-section">
            <a href="{{url('/')}}"class="title">Private</a>
        </div>

        <div class="private-header-right-section">

            @if (Route::has('login'))
            @auth
            <div class="nav-item" style="height: 35px">
                @livewire('navigation-menu')
            </div>
            @else
            <div class="nav-item">
                <a href="{{ route('login') }}">
                    <i class="ri-user-line icon--small"></i>
                    <span>Account</span>
                </a>
            </div>          
            @endauth
            @endif

            <div class="nav-item">
                <a href="{{url('cart')}}" class="cart-wrapper js-cart-wrapper">
                    <i class="ri-shopping-bag-line icon--small" data-content="0">
                        <nav class="cart-navbar js-cart-navbar">
                            <div class="cart-content js-cart-content">
                                
                            </div>

                            <div class="cart-calculate-price">
                                <div class="cart-price">
                                    <p>Subtotal:</p>
                                    <p><span></span> VND</p>
                                </div>
                                <div class="cart-checkout">
                                    CHECKOUT
                                    (<span></span>)
                                </div>
                            </div>
                        </nav>
                    </i>
                    <span>Cart</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Search container -->
    <nav class="search-navbar js-search-navbar">
        <div class="search-container">
            <div class="search-input">
                <input type="text" placeholder="Search" tabindex="-1">
                <i class="ri-search-line search-icon"></i>
            </div>
            <div class="search-hint">
                <p>Trending Searches:</p>
                @if (getIsFeaturedSubCategory()->isNotEmpty())
                    @php $count = 0 @endphp
                    @foreach (getIsFeaturedSubCategory() as $subCategory)
                        @if ($count < 4)
                        <div>
                            <a href="{{url('categories',$subCategory->name)}}">
                                <i class="ri-search-line"></i>
                                {{$subCategory->name}}
                            </a>
                        </div>
                        @php $count++ @endphp
                        @endif
                    @endforeach
                @endif
            </div>

            <div class="search-matched-title">
                <p>Popular Categories</p>
            </div>

            <div class="search-matched-categories">
                @if (getIsFeaturedCategories()->isNotEmpty())
                    @php $count = 0 @endphp
                    @foreach (getIsFeaturedCategories() as $category)
                        @if ($count < 4)
                        <div class="categories-item">
                            <img src="{{ file_exists(public_path('uploads/category/thumb/' . $category->image)) ? asset('uploads/category/thumb/' . $category->image) : asset('uploads/category/thumb/null.png') }}" alt="">
                            <div class="categories-name">
                                <p>{{$category->name}}</p>
                                <a href="{{url('categories',$category->slug)}}">Shop now</a>
                            </div>
                        </div>
                        @php $count++ @endphp
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </nav>

    <!-- Menu container -->
    <nav class="menu-navbar js-menu-navbar">
        <div class="nav-close js-nav-close">
            <i class="ri-close-line"></i>
            Close
        </div>
        <ul class="nav--categories">
            @if (getCategories()->isNotEmpty())
            @foreach (getCategories() as $category)
            <li>
                <span for="btn-1">
                    <a href="{{url('categories',$category->slug)}}">
                        {{ $category->name }}
                    </a>
                    <ul class="nav--sub-categories">
                        @foreach ($category->getSubCategories as $subcategory)
                            @if ($subcategory->showHome == "Yes")
                                <li><a href="{{url('categories', [$category->slug, $subcategory->slug])}}">{{ $subcategory->name }}</a></li>
                            @endif    
                        @endforeach
                    </ul>
                </span>
                <i class="ri-arrow-right-s-line"></i>
            </li>
            @endforeach
            @endif
        </ul>
        <ul class="nav--infor">
            <li>
                <a href="">About Private</a>
            </li>
            <li>
                <a href="{{route('home.services')}}">Services</a>
            </li>
            <li>
                <a href="">Call us</a>
            </li>
            <li>
                <a href="">Find a Store</a>
            </li>
        </ul>
    </nav>
    <div id="overlay"></div>
</header>