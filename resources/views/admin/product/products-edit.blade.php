@extends('admin.layouts.app')
@section('title')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <i class="bi bi-stickies"></i>
    </li>
    <li class="breadcrumb-item breadcrumb-active" aria-current="products"><a href="{{route('products.index')}}">Products</a>/Update</li>
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
                                                        <input type="text" class="form-control" id="product-title" name="title" placeholder="title" value="{{$product->title}}" autocomplete="off">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Slug</label>
                                                    <div class="input-group">
                                                        <input type="text" readonly style="background-color: #C0C0C0;" class="form-control" id="product-slug" name="slug" value="{{$product->slug}}" placeholder="slug">
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
                                                                <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
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
                                                                <option value="{{$subCategory->id}}" {{$product->sub_category_id == $subCategory->id ? 'selected' : ''}}>
                                                                    <?php 
                                                                    $exploded = explode("--", $subCategory->slug);
                                                                    if (count($exploded) >= 2) {
                                                                        $CategoryName = '';
                                                                        if (isset($categories)) {
                                                                            $category = $categories->where('id', $exploded[1])->first();
                                                                            if ($category !== null) {
                                                                                $CategoryName = $category->name;
                                                                            }
                                                                        }
                                                                        echo str_replace("-", " ", $exploded[0]). ' / ' . $CategoryName;
                                                                    } else {
                                                                        echo str_replace("-", " ", $exploded[0]);
                                                                    }
                                                                    ?>
                                                                </option>
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
                                                            <input type="number" class="form-control" id="product-amount" name="amount" value="{{$product->amount}}" autocomplete="off">
                                                            <p></p>
                                                        </div>
                                                    </div>            
                                                    <div>
                                                        <label class="form-label">Price</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="product-price" name="price" value="{{$product->price}}" autocomplete="off">
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
                                                                            <option value="{{$promo->id}}" {{$product->promotion_id == $promo->id ? 'selected' : ''}}>{{$promo->name}}</option>
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
                                                                <input class="form-check-input" type="radio" name="status" id="StatusRadio1" value="1" {{($product->status == 1) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="StatusRadio1">Active</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status" id="StatusRadio2" value="0" {{($product->status == 0) ? 'checked' : ''}}>
                                                                <label class="form-check-label" for="StatusRadio2">Block</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div id="image_id">
                                                    <input type="hidden" id="image_1" name="image_1" >
                                                    <input type="hidden" id="image_2" name="image_2" >
                                                    <input type="hidden" id="image_3" name="image_3" >
                                                    <input type="hidden" id="image_4" name="image_4" >
                                                </div>
												<div class="mb-3">
                                                    <label  class="form-label">Image <span id="count-images">0</span>/4</label>
                                                    <div id="image" class="dropzone dz-clickable">
                                                        <div class="dz-message needsclick">
                                                            <br>Drop files here or click to upload.<br><br>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="image">Image 1</label>
                                                <div>
                                                    <img src="{{ asset('uploads/product/products/thumb/' . (!empty($product->image_1) ? $product->image_1 : 'null.png')) }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="image">Image 2</label>
                                                <div>
                                                    <img src="{{ asset('uploads/product/products/thumb/' . (!empty($product->image_2) ? $product->image_2 : 'null.png')) }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="image">Image 3</label>
                                                <div>
                                                    <img src="{{ asset('uploads/product/products/thumb/' . (!empty($product->image_3) ? $product->image_3 : 'null.png')) }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="image">Image 4</label>
                                                <div>
                                                    <img src="{{ asset('uploads/product/products/thumb/' . (!empty($product->image_4) ? $product->image_4 : 'null.png')) }}" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-10">
												<div class="mb-3">
                                                    <label class="form-label" for="keywords">Keywords</label>
                                                    <div>
                                                        <input style="width: 1100px" type="text" name="keywords" id="product-keywords" value="{{$product->keywords}}" autocomplete="off">
                                                    </div>
                                                </div>
											</div>
                                            <div class="col-md-5">
												<div class="mb-3">
                                                    <label class="form-label" for="detail">Detail</label>
                                                    <div>
                                                        <textarea name="detail" id="product-detail" cols="60" rows="3">{{$product->detail}}</textarea>
                                                    </div>
                                                </div>
											</div>
                                            <div class="col-md-5">
												<div class="mb-3">
                                                    <label class="form-label" for="care">Care</label>
                                                    <div>
                                                        <textarea name="care" id="product-care" cols="75" rows="3">{{$product->care}}</textarea>
                                                    </div>
                                                </div>
											</div>
                                            <div class="col-md-10">
												<div class="mb-3">
                                                    <label class="form-label" for="description">Description</label>
                                                    <div>
                                                        <textarea name="description" id="product-description" cols="144" rows="6">{{$product->description}}</textarea>
                                                    </div>
                                                </div>
											</div>                                            
                                        </div>
                                        <!-- Row end -->

                                        <!-- Form actions footer start -->
                                        <div class="form-actions-footer">
                                            <button type="reset" class="btn btn-light">Reset</button>
                                            <button type="submit" class="btn btn-success" style="color: black;">Update</button>
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
<script>
    $("#productForm").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("products.update", $product->id) }}',
            type: 'put',
            data: element.serializeArray(),
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) {

                    window.location.href="{{route('products.index')}}";

                    alert('product added successfully!');

                    $("#product-title").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    $("#product-slug").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    $("#product-price").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    $("#product-amount").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                } else {
                    var errors = response['errors'];
                    if (errors['title']) {
                        $("#product-title").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['title'])
                    } else {
                        $("#product-title").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }

                    if (errors['slug']) {
                        $("#product-slug").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['slug'])
                    } else {
                        $("#product-slug").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }

                    if (errors['price']) {
                        $("#product-price").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['price'])
                    } else {
                        $("#product-price").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }

                    if (errors['amount']) {
                        $("#product-amount").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['amount'])
                    } else {
                        $("#product-amount").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }
                }

            },
            error: function(jqXHR, exception) {
                console.log("wrong");
            }
        })
    });


    var selectedCategoryId = $("#category").find('option:selected').val();
    var selectedSubCategoryId = $("#subCategory").find('option:selected').val();

    $('#category').change(function() {
        let selectedOption = $(this).find('option:selected');
        selectedCategoryId = selectedOption.val();
        element = $("#product-title");
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) { 
                    var slug = '';

                    if (selectedCategoryId) {
                        slug = response["slug"] + '--' + selectedCategoryId;
                        $('#product-slug').val(slug);
                    }
                    else
                        slug = response["slug"];

                    if (selectedSubCategoryId) {
                        slug  += '--' + selectedSubCategoryId;
                        $('#product-slug').val(slug);
                    }

                    $('#product-slug').val(slug);

                }
            }
        });
    });

    $('#subCategory').change(function() {
        let selectedOption = $(this).find('option:selected');
        selectedSubCategoryId = selectedOption.val();
        element = $("#product-title");
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) { 
                    var slug = '';

                    if (selectedCategoryId) {
                        slug += response['slug'] + '--' + selectedCategoryId;
                    }
                    else
                        slug += response['slug'];

                    if (selectedSubCategoryId) {
                        slug += '--' + selectedSubCategoryId;
                    }

                    $('#product-slug').val(slug);
                }
            }
        });
    });

    $("#product-title").change(function() {
        element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) { 
                    var slug = response["slug"];

                    if (selectedCategoryId) {
                        slug += '--' + selectedCategoryId;
                        $('#product-slug').val(slug);
                    }

                    if (selectedSubCategoryId) {
                        slug += '--' + selectedSubCategoryId;
                        $('#product-slug').val(slug);
                    }

                    $('#product-slug').val(slug);
                    
                }
            }
        });
    });

    Dropzone.autoDiscover = false;
    const dropzone = $("#image").dropzone({
        init: function() {
            this.on('addedfile', function(file) {
                if (this.files.length > 4) {
                    this.removeFile(this.files[4]);
                }
                $("#count-images").html(this.files.length);
            });

            this.on('removedfile', function(file) {
            if (file.inputId) {
                $(file.inputId).val('');
            }
    });
        },
        url: "{{ route('temp-images.create')}}",
        maxFiles: 4,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            updateImageId(file, response.image_id);
        }
    });

    function updateImageId(file, imageId) {
        for (let i = 1; i <= 4; i++) {
            let inputId = "#image_" + i;
            if ($(inputId).val() === '' || $(inputId).val() === imageId) {
                $(inputId).val(imageId);
                file.inputId = inputId;
                break;
            }
        }
    }
</script>
@endsection