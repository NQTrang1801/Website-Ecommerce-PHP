@extends('admin.layouts.app')
@section('title')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <i class="bi bi-stickies"></i>
    </li>
    <li class="breadcrumb-item breadcrumb-active" aria-current="Categories"><a href="{{route('categories.index')}}">Categories</a>/Insert</li>
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
                                    <a class="nav-link active" id="category-tab" data-bs-toggle="tab" href="#category" role="tab" aria-controls="categry" aria-selected="true">ID: {{$category->id}}</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="formsTabContent">

                                <div class="tab-pane fade show active" id="category" role="tabpanel">
                                    <form action="" method="post" id="updateCategoryForm" name="updateCategoryForm">
                                        @csrf
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-8 col-sm-8 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter Category Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="category-name" name="name" placeholder="Name" value="{{$category->name}}" autocomplete="off">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Slug</label>
                                                    <div class="input-group">
                                                        <input type="text" readonly style="background-color: #C0C0C0;" class="form-control" id="category-slug" name="slug" value="{{$category->slug}}" placeholder="slug">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" id="image_id" name="image_id" >
												<div class="mb-3">
                                                    <label class="form-label" for="image">Image Dropzone</label>
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
                                                            <input class="form-check-input" type="radio" name="status" id="StatusRadio1" value="1" {{($category->status == 1) ? 'checked' : ''}}>
                                                            <label class="form-check-label" for="StatusRadio1">Active</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="status" id="StatusRadio2" value="0" {{($category->status == 0) ? 'checked' : ''}}>
                                                            <label class="form-check-label" for="StatusRadio2">Block</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (!empty($category->image))
                                                <div>
                                                    <label class="form-label">Image</label>
                                                    <img style="height: 160px; width: 160px; object-fit: cover" src="{{asset('uploads/category/thumb/'.$category->image)}}" alt="">
                                                </div>
                                                @endif
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
    $("#updateCategoryForm").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("categories.update",$category->id) }}',
            type: 'put',
            data: element.serializeArray(),
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) {

                    window.location.href="{{route('categories.index')}}";

                    alert('Category updated successfully!');

                    $("#category-name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    $("#category-slug").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                } else {
                    if (response["notFound"] == true) 
                    {
                        alert("Category not found");
                        window.location.href = "{{route('categories.index')}}";
                    }
                    var errors = response['errors'];
                    if (errors['name']) {
                        $("#category-name").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['name'])
                    } else {
                        $("#category-name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }

                    if (errors['slug']) {
                        $("#category-slug").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['slug'])
                    } else {
                        $("#category-slug").removeClass('is-invalid')
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

    $("#category-name").change(function() {
        element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'get',
                data: {title: element.val()},
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response["status"] == true)
                    {
                        $('#category-slug').val(response["slug"]);
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