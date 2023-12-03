@extends('admin.layouts.app')
@section('title')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <i class="bi bi-stickies"></i>
    </li>
    <li class="breadcrumb-item breadcrumb-active" aria-current="Categories"><a href="{{route('sub-categories.index')}}">Sub Categories</a>/Insert</li>
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
                                    <a class="nav-link" id="category-tab"  href="{{route('categories.create')}}" role="tab" aria-controls="categry" aria-selected="false">Category</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="subCategory-tab" data-bs-toggle="tab" href="{{route('categories.index')}}" role="tab" aria-controls="sub-category" aria-selected="true">Sub Category</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="imageCategory"  href="{{route('categories.index')}}" role="tab" aria-controls="image-category" aria-selected="false">Image Category</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="formsTabContent">

                                <div class="tab-pane fade show active" id="sub-category" role="tabpanel">
                                    <form action="" method="post" id="insertSubCategoryForm" name="insertSubCategoryForm">
                                        @csrf
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <div class="option-group">
                                                       <select id="categorySelect" name="category" id="category" class="form-control" style="max-width: 710px; overflow: hidden; white-space: normal; word-wrap: break-word;">      
                                                            <option value="">Select a Category</option>                                
                                                            @if ($categories->isNotEmpty())
                                                                @foreach ($categories as $category)
                                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                            @endif               
                                                       </select>
                                                       <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-8 col-sm-8 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter Sub Category Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="sub-category-name" name="name" placeholder="Name" autocomplete="off">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Slug</label>
                                                    <div class="input-group">
                                                        <input type="text" readonly style="background-color: #C0C0C0;" class="form-control" id="sub-category-slug" name="slug" placeholder="slug">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <input type="hidden" id="image_id" name="image_id" >
												<div class="mb-3">
                                                    <label class="form-label" for="image">Image</label>
                                                    <div id="image" class="dropzone dz-clickable">
                                                        <div class="dz-message needsclick">
                                                            <br>Drop files here or click to upload.<br><br>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-8 col-sm-8 col-12">
                                                <div class="mb-3">
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
<script>
    $("#insertSubCategoryForm").submit(function(event) {
        event.preventDefault();
        var element = $("#insertSubCategoryForm");
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("sub-categories.store") }}',
            type: 'post',
            data: element.serializeArray(),
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) {

                    window.location.href="{{route('sub-categories.index')}}";

                    alert('sub category added successfully!');

                    $("#sub-category-name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    $("#sub-category-slug").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    $("#category").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                } else {
                    var errors = response['errors'];
                    if (errors['category']) {
                        $("#category").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['category'])
                    } else {
                        $("#category").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }

                    if (errors['name']) {
                        $("#sub-category-name").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['name'])
                    } else {
                        $("#sub-category-name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }

                    if (errors['slug']) {
                        $("#sub-category-slug").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['slug'])
                    } else {
                        $("#sub-category-slug").removeClass('is-invalid')
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

    var selectedCategoryId = '';

    $('#categorySelect').change(function() {
        let selectedOption = $(this).find('option:selected');
        selectedCategoryId = selectedOption.val();
        element = $("#sub-category-name");
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) { 
                    if (selectedCategoryId) {
                        var subCategorySlug = response["slug"] + '--' + selectedCategoryId;
                        $('#sub-category-slug').val(subCategorySlug);
                    } else {
                        $('#sub-category-slug').val(response["slug"]);
                    }
                }
            }
        });
    });

    $("#sub-category-name").change(function() {
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
                    if (selectedCategoryId) {
                        var subCategorySlug = response["slug"] + '--' + selectedCategoryId;
                        $('#sub-category-slug').val(subCategorySlug);
                    } else {
                        $('#sub-category-slug').val(response["slug"]);
                    }
                }
            }
        });
    });


    Dropzone.autoDiscover = false;
    const dropzone = $("#image").dropzone({
        init: function() {
            this.on('addedfile', function(file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
        },
        url: "{{ route('temp-images.create')}}",
        maxFiles: 1,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, success: function(file, response) {
            $("#image_id").val(response.image_id);
        }
    });
</script>
@endsection