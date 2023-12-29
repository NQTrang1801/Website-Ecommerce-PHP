<div class="products-categories" id="products-categories">
    <div class="container">
        <div class="wrap">
            <div class="heading">
                <h2 class="title">Products Categories</h2>
            </div>
            <div class="dotgrid scrollto">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $chunks = $category->getSubCategories->chunk(6);
                            $count = 1;
                        @endphp

                        @foreach ($chunks as $key => $chunk)
                            <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                                <div class="products-categories">
                                    <div class="container">
                                        <div class="wrap">
                                            <div class="dotgrid scrollto">
                                                <div class="wrapper">
                                                    @foreach ($chunk as $subCategory)
                                                        @if ($subCategory->showHome == 'Yes')
                                                            <div class="item">
                                                                <div class="dot-image">
                                                                    <div class="thumbnail hover">
                                                                        <a href="#" class="category-link"
                                                                            id="type-{{ $count }}-link"
                                                                            data-section-id="category-view-{{ $count }}">
                                                                            <img src="{{ file_exists(public_path('uploads/sub category/thumb/' . $subCategory->image)) ? asset('uploads/sub category/thumb/' . $subCategory->image) : asset('uploads/sub category/thumb/null.png') }}"
                                                                                alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="dot-info">
                                                                    <h3 class="dot-title">{{ $subCategory->name }}</h3>
                                                                </div>
                                                            </div>
                                                            @php
                                                                $count++;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
