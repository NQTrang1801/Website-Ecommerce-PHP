@extends('admin.layouts.app')
@section('title')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <i class="bi bi-stickies"></i>
    </li>
    <li class="breadcrumb-item breadcrumb-active" aria-current="products"><a href="{{route('products.index')}}">Products</a>/Insert</li>
</ol>
@endsection
@section('content')
    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row gx-3">
            <div class="col-xxl-12">
                <div class="card card-370">
                    <div class="card-body">
                        <div class="custom-tabs-container">
                            <ul class="nav nav-tabs" id="formsTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="product-tab" data-bs-toggle="tab" href="{{route('products.index')}}" role="tab" aria-controls="product" aria-selected="true">Product</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="Variantss"  href="#" role="tab" aria-controls="Variantss" aria-selected="false">Variantss</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="formsTabContent">

                                <div class="tab-pane fade show active" id="product" role="tabpanel">
                                    <form action="" method="post" id="productForm" name="productForm">
                                        @csrf
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-8 col-sm-8 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter Product title</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="product-name" name="title" placeholder="title" autocomplete="off">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-1 col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Slug</label>
                                                    <div class="input-group">
                                                        <input type="text" readonly style="background-color: #C0C0C0;" class="form-control" id="product-slug" name="slug" placeholder="slug">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-2">
                                                <label class="form-label">Category</label>
                                                <div class="option-group">
                                                <select name="category" id="category" class="form-control" style="overflow: hidden; white-space: normal; word-wrap: break-word;">      
                                                        <option value="">select</option>                                
                                                        @if ($categories->isNotEmpty())
                                                            @foreach ($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        @endif               
                                                </select>
                                                <p></p>
                                                </div>
                                            </div>
                                            <div class="col-xxl-2">
                                                <label class="form-label">Sub Category</label>
                                                <div class="option-group">
                                                   <select name="subCategory" id="subCategory" class="form-control" style="overflow: hidden; white-space: normal; word-wrap: break-word;">      
                                                        <option value="">select</option>                                
                                                        @if ($subCategories->isNotEmpty())
                                                            @foreach ($subCategories as $subCategory)
                                                                <option value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                                            @endforeach
                                                        @endif               
                                                   </select>
                                                   <p></p>
                                                </div>
                                            </div>
                                            <div class="col-xxl-2">
                                                <div class="mb-3">
                                                    <div>
                                                        <label class="form-label">Amount</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="product-amount" name="amount" autocomplete="off">
                                                            <p></p>
                                                        </div>
                                                    </div>            
                                                    <div>
                                                        <label class="form-label">Price</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="product-price" name="price" autocomplete="off">
                                                            <p></p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="form-label">Promotion</label>
                                                        <div class="option-group">
                                                            <select name="promotion" id="promotion" class="form-control" style="overflow: hidden; white-space: normal; word-wrap: break-word;">      
                                                                    <option value="">select</option>                                
                                                                    @if ($promotion->isNotEmpty())
                                                                        @foreach ($promotion as $promo)
                                                                            <option value="{{$promo->id}}">{{$promo->name}}</option>
                                                                        @endforeach
                                                                    @endif               
                                                            </select>
                                                            <p></p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="form-label">Status</label>
                                                        <div class="mt-2">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status" id="StatusRadio1" value="1" checked>
                                                                <label class="form-check-label" for="StatusRadio1">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status" id="StatusRadio2" value="0">
                                                                <label class="form-check-label" for="StatusRadio2">Block</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="hidden" id="image_id" name="image_id" >
												<div class="mb-3">
                                                    <label class="form-label" for="image">Images <span>0</span>/4</label>
                                                    <div id="image" class="dropzone dz-clickable">
                                                        <div class="dz-message needsclick">
                                                            <br>Drop files here or click to upload.<br><br>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
                                            <div class="col-md-10">
												<div class="mb-3">
                                                    <label class="form-label" for="keywords">Keywords</label>
                                                    <div>
                                                        <input style="width: 1100px" type="text" name="keywords" id="product-keywords" autocomplete="off">
                                                    </div>
                                                </div>
											</div>
                                            <div class="col-md-5">
												<div class="mb-3">
                                                    <label class="form-label" for="detail">Detail</label>
                                                    <div>
                                                        <textarea name="detail" id="product-detail" cols="60" rows="3"></textarea>
                                                    </div>
                                                </div>
											</div>
                                            <div class="col-md-5">
												<div class="mb-3">
                                                    <label class="form-label" for="care">Care</label>
                                                    <div>
                                                        <textarea name="care" id="product-care" cols="75" rows="3"></textarea>
                                                    </div>
                                                </div>
											</div>
                                            <div class="col-md-10">
												<div class="mb-3">
                                                    <label class="form-label" for="description">Description</label>
                                                    <div>
                                                        <textarea name="description" id="product-description" cols="144" rows="6"></textarea>
                                                    </div>
                                                </div>
											</div>                                            
                                        </div>
                                        <!-- Row end -->

                                        <!-- Form actions footer start -->
                                        <div class="form-actions-footer">
                                            <button type="reset" class="btn btn-light">Reset</button>
                                            <button type="submit" class="btn btn-success" style="color: black;">Create</button>
                                        </div>
                                        <!-- Form actions footer end -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Row end -->

    </div>
    <!-- Content wrapper end -->
@endsection

@section('customJs')
@endsection