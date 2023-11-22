<main>
    @if (Route::has('login'))
        @auth
                <h1 style="margin-top: 100px;"></h1>
        @else
            <h1 class="page-title" style="width: 100%; padding: 60px 0px 14px 56px; font-weight: 500; font-family: 'Cinzel', 'Arial', serif;">Shopping Bag</h1>
        @endauth
    @endif
    <div class="container">
        <div class="l-container">
            <div class="l-top-container">
            @if (Route::has('login'))
                @auth
                    <p><h1 style="width: 100%; font-size: 30px; font-weight: 500; font-family: 'Cinzel', 'Arial', serif;">Shopping Bag</h1></p>
                    <p></p>
                @else
                    <p>Personalized Shopping Experience With an RL Account</p>
                    <p><a href="{{url('login')}}">Sign In</a> or <a href="{{url('login')}}">Create an Account</a> for complimentary shipping on your
                        orders (<span>Details</span>)</p>
                @endauth
            @endif
            </div>
            <div class="items-cart">
                <!-- data -->
            </div>

        </div>

        <div class="r-container">
            <div class="r-container-head">
                <span>ORDER SUMMARY</span>
            </div>
            <div>
                <div class="inf-order">
                    <!-- data -->
                </div>
                <div class="promo-code-wrapper">
                    <span>Apply Promo Code</span>
                    <i class="ri-arrow-down-s-line">
                        <input type="text" placeholder="Enter Promo Code">
                    </i>
                </div>
                <div class="checkout-wapper">
                    <button>PROCEED TO CHECKOUT</button>
                </div>
            </div>
        </div>
    </div>
</main>