<div class="products-categories" id="products-categories">
    <div class="container">
        <div class="wrap">
            <div class="heading">
                <h2 class="title">Products Categories</h2>
            </div>
            <div class="dotgrid scrollto">
                <div class="wrapper">
                    @if ($category && $category->getSubCategories->isNotEmpty())
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($category->getSubCategories as $subCategory)
                            @if ($subCategory->showHome == "Yes")
                                <div class="item">
                                    <div class="dot-image">
                                        <div class="thumbnail hover">
                                            <a href="#" id="type-{{$count}}-link">
                                                <img src="{{ file_exists(public_path('uploads/sub category/thumb/' . $subCategory->image)) ? asset('uploads/sub category/thumb/' . $subCategory->image) : asset('uploads/sub category/thumb/null.png') }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dot-info">
                                        <h3 class="dot-title">{{$subCategory->name}}</h3>
                                        <!-- Add other information related to subCategory if needed -->
                                    </div>
                                </div>
                                @php
                                    $count++;
                                @endphp
                            @endif
                        @endforeach
                    @else
                        <!-- Handle case when there are no categories or subcategories -->
                        <p>No categories or subcategories found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
