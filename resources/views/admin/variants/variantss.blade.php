@extends('admin.layouts.app')

@section('styles')
<style>
    .table th,
    .table td {
        padding: 8px;
        max-width: 200px; 
    }
</style>

@endsection

@section('title')
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<i class="bi bi-stickies"></i>
	</li>
	<li class="breadcrumb-item breadcrumb-active" aria-current="Variantss">Variantss</li>
</ol>
@endsection

@section('search-content')
<form action="" method="get">
	<div class="input-group">
		<input type="text" name="keyword" class="form-control" value="{{Request::get('keyword')}}" placeholder="Search">
		<button class="btn" type="submit">
			<i class="bi bi-search"></i>
		</button>
	</div>
</form>
@endsection

@section('content')
	<!-- Content wrapper start -->
	<div class="content-wrapper">

		<!-- Row start -->
		<div class="row gx-3">
			<div class="col-sm-12 col-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">View
							<button onclick="window.location.href='{{ route("variantss.index")}}'" style="margin-left: 32px; border: 1px solid; padding: 0px 10px; font-size: 16px; border-radius: 12px;">refesh</button>
						</div>
                        <div>
							<a href="#">
								<button id="delete-variantss" type="button" class="w-40 btn btn-success btn-rounded" style="color: black;">Delete</button>
							</a>
						</div>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table v-middle m-0">
								<thead>
									<tr>
										<th>ID</th>
										<th>title</th>
                                        <th>Product</th>
										<th>Size</th>
                                        <th>Color</th>
                                        <th>Promo</th>
                                        <th>QTY</th>
                                        <th>price</th>
                                        <th>Image Tag</th>
										<th>Create At</th>
										<th>Update At</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@if ($variantss->isNotEmpty())
										@foreach ($variantss as $variants)
										<tr>
											<td>
												<p>{{$variants->id}}</p>
											</td>
											<td>
												<p>{{$variants->title}}</p>
											</td>
                                            <td>
												<p>{{$variants->product_id}}</p>
											</td>
                                            <td>
												<p>{{$variants->size}}</p>
											</td>
                                            <td>
												<p>{{$variants->color}}</p>
											</td>
                                            <td>
												<p>{{$variants->promo}}</p>
											</td>
                                            <td>
												<p>{{$variants->quantity}}</p>
											</td>
                                            <td>
												<p>{{ number_format($variants->price, 0, ',', '.') }}</p>
											</td>
                                            <td>
                                                <img src="{{ asset('uploads/product/variantss/thumb/' . (!empty($variants->image) ? $variants->image : 'null.png')) }}" alt="" style="width: 20px; height: 20px">
                                            </td>
											<td>{{$variants->created_at}}</td>
											<td>{{$variants->updated_at}}</td>
											<td>
												@if($variants->status == 1)
													<span class="badge shade-green min-70">Active</span>
												@else
													<span class="badge shade-red min-70">block</span>
												@endif
											</td>
											<td>
												<div class="actions">
													<div class="icon">
														<a href="{{ route('products.edit',$variants->product_id)}}"><i class="bi bi-pencil-square"></i></a>
													</div>
													<div class="icon">
														<input type="checkbox" class="form-check-input" style="margin: 6px 0px 6px 6px" data-variant-id="{{$variants->id}}">
													</div>
												</div>
											</td>
										</tr>
										@endforeach
									@else
										<tr>
											<td colspan="13">Records not found</td>
										</tr>
									@endif

								</tbody>
							</table>
							<nav aria-label="Page Navigation" style="margin-top: 40px">
								{{ $variantss->links()}}
								
							</nav>
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
// DELETE

const selectedVariants = [];

$('.form-check-input').on('change', function() {
    const id = $(this).data('variant-id');
    if ($(this).is(':checked')) {
        selectedVariants.push(id);
    } else {
        const selectedIndex = selectedVariants.indexOf(id);
        if (selectedIndex !== -1) {
            selectedVariants.splice(selectedIndex, 1);
        }
    }
});

$('#delete-variantss').on('click', function(event) {
    event.preventDefault();
    if (selectedVariants.length > 0) {
        if (confirm('Are you sure you want to delete the selected variants?')) {
            selectedVariants.forEach(function(id) {
                deleteVariant(id);
            });
        }
    } else {
        alert('Please select at least one variant to delete');
    }
});

function deleteVariant(id) {
    var url = '{{ route("variantss.delete", ":id") }}';
    var newUrl = url.replace(':id', id);
    $.ajax({
        url: newUrl,
        type: 'delete',
        data: {},
        dataType: 'json+++++++++++++++++++++++++',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            $("button[type=submit]").prop('disabled', false);
            if (response["status"] == true) {
                alert("Biến thể đã được xóa thành công");
                window.location.reload();
            } else {
                alert("not found: " + response['id']);
            }
        }
    });
}
</script>

@endsection