<div class="products-categories" id="products-categories">
    <div class="container">
        <div class="wrap">
            <div class="heading">
                <h2 class="title">Products Categories</h2>
            </div>
            <div class="dotgrid scrollto">
                <div class="wrapper">
                    @if ($category->isNotEmpty())
                        @if ($category[0]->getSubCategories->isNotEmpty())
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($category[0]->getSubCategories as $subCategory)
                                @if ($subCategory->showHome == "Yes")
                                    <div class="item">
                                        <div class="dot-image">
                                            <div class="thumbnail hover">
                                                <a href="#" id="type-{{$count}}-link"><img src="{{ file_exists(public_path('uploads/sub category/thumb/' . $subCategory->image)) ? asset('uploads/sub category/thumb/' . $subCategory->image) : asset('uploads/sub category/thumb/null.png') }}" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="dot-info">
                                            <h3 class="dot-title">{{$subCategory->name}}</h3>
                                            <!-- <p class="grey-color">lorem ipsum dolor sit amet consectetur</p> -->
                                        </div>
                                    </div>
                                    @php
                                        $count++;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        @else
                        @if (1)
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>