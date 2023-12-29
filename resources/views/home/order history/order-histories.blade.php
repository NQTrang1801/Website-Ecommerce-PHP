@extends('layouts.app-home')

@section('styles')
    <base href="/public">
    <link rel="stylesheet" href="home/styles/pages/order-history.css">
@endsection

@section('content')
    <main class="content">
        {{-- time lists --}}
        <div class="time-lists-wrapper">
            <div>
                <div>
                    <i class="ri-history-fill"></i>
                    <p class="order-title"><b>ORDER HISTORY</b></p>
                </div>

                <div>
                    <select name="time-ordered" id="time-ordered">
                        <option value="choose">Choose</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="7days">Last 7 days</option>
                        <option value="30days">Lasy 30 days</option>
                        <option value="90days">Last 90 days</option>
                        <option value="6months">Last 6 months</option>
                        <option value="12months">Last 12 months</option>
                        <option value="2years">Last 2 years</option>
                    </select>
                    <ul class="time-lists" style="height: 600px; overflow-y: scroll;">
                        <li>24 May 2023</li>
                        <li>28 May 2023</li>
                        <li>12 June 2023</li>
                        <li>28 July 2023</li>
                        <li>04 Aug 2023</li>
                        <li>24 May 2023</li>
                        <li>28 May 2023</li>
                        <li>12 June 2023</li>
                        <li>28 July 2023</li>
                        <li>04 Aug 2023</li>
                        <li>24 May 2023</li>
                        <li>28 May 2023</li>
                        <li>12 June 2023</li>
                        <li>28 July 2023</li>
                        <li>04 Aug 2023</li>
                        <li>24 May 2023</li>
                        <li>28 May 2023</li>
                        <li>12 June 2023</li>
                        <li>28 July 2023</li>
                        <li>04 Aug 2023</li>
                    </ul>
                </div>
            </div>

            <div class="return">
                <i class="ri-arrow-left-s-line"></i>
                <b>MY SHOPPING BAG</b>
            </div>
        </div>

        {{-- ordered products --}}
        <div class="odered-products">
            <div class="odered-products-header">
                <div class="order-details">ORDER DETAILS</div>
                <div>
                    <p class="light-color">ORDER TOTAL</p>
                    <p>560.000 <span>VND</span></p>
                </div>
                <div>
                    <p class="light-color">STATUS</p>
                    <p><b>Fulfilled</b></p>
                </div>
            </div>
            <div class="odered-products-body">
                <div class="odered-sub-body">
                    <p>28 May 2023</p>
                </div>

                <div class="odered-main-body">
                    <div class="odered-body-wrapper">
                        <a href="#">
                            <img src="pictures/products/sweater-women.jpg" alt="">
                        </a>
                        <div class="odered-body-info">
                            <p class="light-color">KNIT SWEATER WITH TRIMS</p>
                            <div>
                                <p>360.000 <span>VND</span></p>
                                <button>REORDER</button>
                            </div>
                        </div>
                    </div>

                    <div class="odered-body-wrapper">
                        <a href="#">
                            <img src="pictures/products/sweater-women.jpg" alt="">
                        </a>
                        <div class="odered-body-info">
                            <p class="light-color">KNIT SWEATER WITH TRIMS</p>
                            <div>
                                <p>360.000 <span>VND</span></p>
                                <button>REORDER</button>
                            </div>
                        </div>
                    </div>

                    <div class="odered-body-wrapper">
                        <a href="#">
                            <img src="pictures/products/sweater-women.jpg" alt="">
                        </a>
                        <div class="odered-body-info">
                            <p class="light-color">KNIT SWEATER WITH TRIMS</p>
                            <div>
                                <p>360.000 <span>VND</span></p>
                                <button>REORDER</button>
                            </div>
                        </div>
                    </div>

                    <div class="odered-body-wrapper">
                        <a href="#">
                            <img src="pictures/products/sweater-women.jpg" alt="">
                        </a>
                        <div class="odered-body-info">
                            <p class="light-color">KNIT SWEATER WITH TRIMS</p>
                            <div>
                                <p>360.000 <span>VND</span></p>
                                <button>REORDER</button>
                            </div>
                        </div>
                    </div>

                    <div class="odered-body-wrapper">
                        <a href="#">
                            <img src="pictures/products/sweater-women.jpg" alt="">
                        </a>
                        <div class="odered-body-info">
                            <p class="light-color">KNIT SWEATER WITH TRIMS</p>
                            <div>
                                <p>360.000 <span>VND</span></p>
                                <button>REORDER</button>
                            </div>
                        </div>
                    </div>

                    <div class="odered-body-wrapper">
                        <a href="#">
                            <img src="pictures/products/sweater-women.jpg" alt="">
                        </a>
                        <div class="odered-body-info">
                            <p class="light-color">KNIT SWEATER WITH TRIMS</p>
                            <div>
                                <p>360.000 <span>VND</span></p>
                                <button>REORDER</button>
                            </div>
                        </div>
                    </div>

                    <div class="odered-body-wrapper">
                        <a href="#">
                            <img src="pictures/products/sweater-women.jpg" alt="">
                        </a>
                        <div class="odered-body-info">
                            <p class="light-color">KNIT SWEATER WITH TRIMS</p>
                            <div>
                                <p>360.000 <span>VND</span></p>
                                <button>REORDER</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script type="module" src="home/scripts/order-history.js"></script>
@endsection
