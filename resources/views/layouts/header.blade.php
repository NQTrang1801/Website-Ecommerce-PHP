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
                <input type="text" placeholder="Search">
                <i class="ri-search-line search-icon"></i>
            </div>

            <div class="search-hint">
                <p>Trending Searches:</p>
                <div>
                    <a href="{{url('categories','jeans')}}">
                        <i class="ri-search-line"></i>
                        Jeans
                    </a>
                </div>
                <div>
                    <a href="{{url('categories','jackets')}}">
                        <i class="ri-search-line"></i>
                        Jackets
                    </a>
                </div>
                <div>
                    <a href="{{url('categories','bags')}}">
                        <i class="ri-search-line"></i>
                        Bags
                    </a>
                </div>
                <div>
                    <a href="{{url('categories','hoodie')}}">
                        <i class="ri-search-line"></i>
                        Hoodie
                    </a>
                </div>
            </div>

            <div class="search-matched-title">
                <p>Popular Categories</p>
            </div>

            <div class="search-matched-categories">
                <div class="categories-item">
                    <img src="pictures/display-products/female-model.jpg" alt="">
                    <div class="categories-name">
                        <p>Women</p>
                        <a href="{{url('categories','women')}}">Shop now</a>
                    </div>
                </div>
                <div class="categories-item">
                    <img src="pictures/display-products/male-model.jpg" alt="">
                    <div class="categories-name">
                        <p>Men</p>
                        <a href="{{url('categories','men')}}">Shop now</a>
                    </div>
                </div>
                <div class="categories-item">
                    <img src="pictures/display-products/children-model.jpg" alt="">
                    <div class="categories-name">
                        <p>Kids</p>
                        <a href="{{url('categories','kids-and-baby')}}">Shop now</a>
                    </div>
                </div>
                <div class="categories-item">
                    <img src="pictures/display-products/home-decoration.jpg" alt="">
                    <div class="categories-name">
                        <p>Home</p>
                        <a href="{{url('categories','home')}}">Shop now</a>
                    </div>
                </div>
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
            <li>
                <span for="btn-1"><a href="{{url('categories','women')}}">Women</a></span>
                <i class="ri-arrow-right-s-line"></i>
            </li>
            <li>
                <span><a href="{{url('categories','men')}}">Men</a></span>
                <i class="ri-arrow-right-s-line"></i>
            </li>
            <li>
                <span><a href="{{url('categories','kids-and-baby')}}">Kids & Baby</a></span>
                <i class="ri-arrow-right-s-line"></i>
            </li>
            <li>
                <span><a href="{{url('categories','home')}}">Home</a></span>
                <i class="ri-arrow-right-s-line"></i>
            </li>
            <li>
                <span><a href="{{url('categories','gifts')}}">Gifts</a></span>
                <i class="ri-arrow-right-s-line"></i>
            </li>
            <li>
                <span><a href="{{url('categories','new')}}">New</a></span>
                <i class="ri-arrow-right-s-line"></i>
            </li>
            <li>
                <span><a href="{{url('categories','sale')}}">Sale</a></span>
                <i class="ri-arrow-right-s-line"></i>
            </li>
        </ul>
        <ul class="nav--infor">
            <li>
                <a href="">About Private</a>
            </li>
            <li>
                <a href="">Services</a>
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