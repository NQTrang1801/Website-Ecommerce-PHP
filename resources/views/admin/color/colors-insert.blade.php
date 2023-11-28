@extends('admin.layouts.app')

@section('title')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <i class="bi bi-stickies"></i>
    </li>
    <li class="breadcrumb-item breadcrumb-active" aria-current="Colors"><a href="{{route('colors.index')}}">Colors</a>/Insert</li>
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
                                    <a class="nav-link active" id="colors-tab" data-bs-toggle="tab" href="{{route('colors.index')}}" role="tab" aria-controls="colors" aria-selected="true">Color</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="formsTabContent">

                                <div class="tab-pane fade show active" id="colors" role="tabpanel">
                                    <form action="" method="post" id="colorForm" name="colorForm">
                                        @csrf
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-8 col-sm-8 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Enter color Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="color-name" name="name" placeholder="Name" autocomplete="off">
                                                        <p></p>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Enter color Code</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="color-code" name="code" placeholder="code" autocomplete="off">
                                                        <p></p>
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
    $("#colorForm").submit(function(event) {
        event.preventDefault();
        var element = $("#colorForm");
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("colors.store") }}',
            type: 'post',
            data: element.serializeArray(),
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) {

                    window.location.href="{{route('colors.index')}}";

                    alert('color added successfully!');

                    $("#color-name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    $("#color-code").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                } else {
                    var errors = response['errors'];
                    if (errors['name']) {
                        $("#color-name").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['name'])
                    } else {
                        $("#color-name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                    }

                    if (errors['code']) {
                        $("#color-code").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback').html(errors['code'])
                    } else {
                        $("#color-code").removeClass('is-invalid')
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
</script>
@endsection