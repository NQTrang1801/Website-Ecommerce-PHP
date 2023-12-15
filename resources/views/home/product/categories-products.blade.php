@if ($category->isNotEmpty())
    @if ($category[0]->getSubCategories->isNotEmpty())
        @php
            $count = 1; 
            $typeNum = 1;  
        @endphp
        @foreach ($category[0]->getSubCategories as $subCategory)
            @if ($subCategory->showHome == "Yes")
                <div class="category-view-{{$count}} type-{{$typeNum}}" id="category-view-{{$typeNum}}">
                    <div class="container">
                        <div class="wrap">
                            <div class="heading">
                                <h2 class="title" id="category-{{$typeNum}}">{{$subCategory->name}}</h2>
                            </div>
                            <div class="inner-wrapper">
                                <div class="dotgrid">
                                    <div class="wrapper">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="see-more">
                        <button>See more</button>
                    </div>
                </div>
                @php
                    $typeNum++;
                    if ($typeNum > 4)
                        $typeNum = 1; 

                    if ($count == 2)
                        $count--;
                    else {
                        $count++;
                    }   
                @endphp
            @endif
        @endforeach
    @endif
@endif
