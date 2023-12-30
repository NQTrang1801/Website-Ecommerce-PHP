<form action="{{ route('vnpay.payment') }}" method="POST" id="paymentForm">
    @csrf
    <div class="container">
        <div class="l-container" style="padding-bottom: 200px">
            <div class="l-top-container">
                <p>DELIVERY</p>
            </div>
            <div class="l-mid-container">
                <p><i class="ri-truck-line"></i> Ship to an address</p>
            </div>
            <div class="l-bot-container">
                <div class="info-wraper">
                    <p>Information</p>
                    <div class="gender">
                        <span><input type="radio" name="gender" value="male"> male</span>
                        <span><input type="radio" name="gender" value="female"> female</span>
                        <span><input type="radio" name="gender" value="other"> other</span>
                    </div>
                    <div class="contact">
                        <input type="text" name="name" placeholder="Name">
                        <input type="text" name="phone" placeholder="Phone">
                    </div>
                    @if (Route::has('login'))
                    @auth
                    <input readonly type="hidden" name="amount" id="amount-form" value="{{$cost}}">
                    <input readonly type="hidden" name="userId" id="amount-form" value="{{Auth::user()->id}}">
                    @else
                    <input readonly type="hidden" id="amount-form" value="{{$cost+40000}}">
                    <input readonly type="hidden" name="userId" id="amount-form" value="">
                    @endauth
                    @endif
                </div>
                <div class="adress-wraper">
                    <p>Shipping address</p>
                    <div class="info-address">
                        <input type="text" name="address" placeholder="Address">
                    </div>
                    <div class="requirements">
                        <input name="require" type="text" placeholder="Other requirements">
                        <div class="requirements-check">
                            <span><input type="checkbox" name="printInvoice" value="1"> Print invoice</span>
                            <span><input type="radio" name="pay" checked> Digital payment - VNPAY</span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="r-container">
            <div class="r-container-head">
                <span>ORDER SUMMARY</span>
            </div>
            <div>
                <div class="inf-order">
                    <p>Subtotal</p>
                    <p><span>{{number_format($cost, 0, ',', '.')}}</span> VND</p>
                    <p>Standard Shipping</p>
                    @if (Route::has('login'))
                    @auth
                    <p><span>0</span> VND</p>
                    <p>Free when you <a href="{{ url('login') }}">Sign in</a> or <a href="{{ url('login') }}">Create
                        an Account</a></p>
                    <p></p>
                    <p>Estimated Total</p>
                    <p><span>{{ number_format($cost, 0, ',', '.') }} </span> VND</p>
                    @else
                    <p><span>40.000</span> VND</p>
                    <p>Free when you <a href="{{ url('login') }}">Sign in</a> or <a href="{{ url('login') }}">Create
                            an Account</a></p>
                    <p></p>
                    <p>Estimated Total</p>
                    <p><span>{{ number_format($cost + 40000, 0, ',', '.') }}</span> VND</p>
                    @endauth
                    @endif
                    <p>Taxes finalized at the end of checkout</p>
                </div>
                <div class="checkout-wapper">
                    <input name='redirect' type="submit" value="Order now">
                </div>
            </div>
        </div>
    </div>
</form>
