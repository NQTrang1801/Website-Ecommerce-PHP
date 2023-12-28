@extends('admin.layouts.app')

@section('styles')
<style>
    .table th,
    .table td {
        padding: 8px;
        max-width: 200px; 
    }
	.product-images {
		display: grid;
		grid-template-columns: 1fr 1fr 1fr 1fr;
		column-gap: 8px;
		margin-bottom: 20px
	}

	.product-images img {
		object-fit: contain;
	}

	.product-images label {
		float: right;
	}

</style>
@endsection

@section('title')
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<i class="bi bi-stickies"></i>
	</li>
	<li class="breadcrumb-item breadcrumb-active" aria-current="Products">Products</li>
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
							<button onclick="window.location.href='{{ route("sub-categories.index")}}'" style="margin-left: 32px; border: 1px solid; padding: 0px 10px; font-size: 16px; border-radius: 12px;">refesh</button>
						</div>
						<div>
							<a href="{{route('products.create')}}">
								<button type="button" class="w-40 btn btn-success btn-rounded" style="color: black;">New product</button>
							</a>
						</div>

					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table v-middle m-0">
								<thead>
									<tr>
										<th>ID</th>
										<th>Title</th>
										<th>Category</th>
										<th>Sub Category</th>
                                        <th>Price</th>
										<th>Promo</th>
                                        <th>Amount</th>
										<th>Update At</th>
										<th>Status</th>
										<th>ShowHome</th>
										<th>isFeatured</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@if ($products->isNotEmpty())
										@foreach ($products as $product)
										<tr>
											<td>
												<p>{{$product->id}}</p>
											</td>
											<td>
												<p>{{$product->title}}</p>
											</td>
											<td>
												<p>
													{{$product->category_name}}
												</p>
											</td>											
                                            <td>
												<p>
													{{$product->subCategory_name}}
												</p>
											</td>
                                            <td>
                                                <p>{{ number_format($product->price, 0, ',', '.') }}</p>
                                            </td>
											<td>
                                                <p>{{$product->promotion_value}}</p>
                                            </td>
											<td>
                                                <p>{{$product->amount}}</p>
                                            </td>
											<td>{{$product->updated_at}}</td>
											<td id="status-id-{{$product->id}}">
												@if($product->status == 1)
													<span class="badge shade-green min-70">Active</span>
												@else
													<span class="badge shade-red min-70">block</span>
												@endif
											</td>
											<td>
												<div class="actions">
													<div class="form-check form-switch">
														<input id="showHome-id-{{$product->id}}" class="form-check-input show-home-checkbox" type="checkbox" role="switch" data-product-id="{{$product->id}}" {{ $product->showHome == 'Yes' ? 'checked' : '' }}>
													</div>
												</div>
											</td>
											<td>
												<div class="actions">
													<div class="form-check form-switch">
														<input id="featured-id-{{$product->id}}" class="form-check-input featured-checkbox" type="checkbox" role="switch" data-product-id="{{$product->id}}" {{ $product->is_featured == 1 ? 'checked' : '' }}>
													</div>
												</div>
											</td>
											<td>
												<div class="actions">
                                                    <a href="#" class="btn-detail" id="btn-detail-{{$product->id}}">
                                                        <i class="bi bi-list text-green"></i>
                                                    </a>
													<div class="icon">
														<a href="{{ route('products.edit',$product->id)}}"><i class="bi bi-pencil-square"></i></a>
													</div>
													<div class="icon">
														<a href="#" onclick = "deleteProduct({{$product->id}})"><i class="bi bi-x-square" style="color: red"></i></a>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="12">
												<div class="product-detail" style="display: none" id="pro-{{$product->id}}">
														<div><strong>Slug: </strong><span>{{$product->slug}}</span></div>
														<div><strong>Description: </strong><pre>{{$product->description}}</pre></div>
														<div><strong>Detail: </strong><span>{{$product->detail}}</span></div>
														<div><strong>Care: </strong><span>{{$product->care}}</span></div>
														<div><strong>Create date: </strong><span>{{$product->created_at}}</span></div>
														<div class="drop-detail" style="">
															<div>
																<strong>Images: </strong>
																<div class="product-images">
																	@if (!empty($product->images_id))
																		<div>
																			<label for="">image 1</label>
																			<a href="#" class="edit-contact-card js-image-view" data-bs-toggle="modal" data-bs-target="#image-view">
																				<img src="{{ asset('uploads/product/products/thumb/' . (!empty($product->image_1) ? $product->image_1 : 'null.png')) }}" alt="">
																			</a>												
																		</div>
																		<div>
																			<label for="">image 2</label>
																			<a href="#" class="edit-contact-card js-image-view" data-bs-toggle="modal" data-bs-target="#image-view">
																				<img src="{{asset('uploads/product/products/thumb/'. (!empty($product->image_2) ? $product->image_2 : 'null.png'))}}" alt="">
																			</a>
																		</div>
																		<div>
																			<label for="">image 3</label>
																			<a href="#" class="edit-contact-card js-image-view" data-bs-toggle="modal" data-bs-target="#image-view">
																				<img src="{{asset('uploads/product/products/thumb/'. (!empty($product->image_3) ? $product->image_3 : 'null.png'))}}" alt="">
																			</a>
																		</div>
																		<div>
																			<label for="">image 4</label>
																			<a href="#" class="edit-contact-card js-image-view" data-bs-toggle="modal" data-bs-target="#image-view">
																				<img src="{{asset('uploads/product/products/thumb/'. (!empty($product->image_4) ? $product->image_4 : 'null.png'))}}" alt="">
																			</a>
																		</div>
																		
																	@endif
																</div>
	
															</div>
															<hr>															
														</div>
												</div>
											</td>
										</tr>
										@endforeach
									@else
										<tr>
											<td colspan="12">Records not found</td>
										</tr>
									@endif

								</tbody>
							</table>
							<nav aria-label="Page Navigation" style="margin-top: 40px">
								{{ $products->links()}}
								
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
@section('model')
<div class="modal fade" id="image-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editVariantLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            @csrf
                <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    <img id="imageToShow" src="" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
	    </div>
    </div>
</div>
@endsection
@section('customJs')
<script>
	$('.js-image-view img').on('click', function(e) {
        e.preventDefault(); 
        var imageUrl = $(this).attr('src');
        $('#imageToShow').attr('src', imageUrl);
    });
	
	document.querySelectorAll('.show-home-checkbox')
		.forEach(function(checkbox) {
    		checkbox.addEventListener('change', function() {
				var productId = this.dataset.productId;
				var value = this.checked ? 'Yes' : 'No';
    			handleToggleShowHome(productId, value);
			});
		});

	function handleToggleShowHome(id, value) {
		var url = '{{route("products.showHome","ID")}}';
		var newUrl = url.replace("ID",id);
		var status = $('#status-id-' + id).text().trim();
		if (status === 'Active') {
			$.ajax({
				url: newUrl,
				type: 'PUT',
				data: {
					showHome: value
				},
				dataType: 'json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(response) {
					if (response.status === true) {
						console.log('ShowHome updated successfully');
					} else {
						console.log('Failed to update ShowHome');
					}
				},
				error: function(xhr, status, error) {
					console.error('Error updating ShowHome:', error);
				}
			});
		}
		else
		{
			alert('You can only change showHome when status is Active.');
			$('#showHome-id-' + id).prop('checked', false);
		}

	}

	document.querySelectorAll('.featured-checkbox')
		.forEach(function(checkbox) {
    		checkbox.addEventListener('change', function() {
				var productId = this.dataset.productId;
				var value = this.checked ? 1 : 0;
    			handleToggleFeatured(productId, value);
			});
		});

	function handleToggleFeatured(id, value) {
		var url = '{{route("products.isFeatured","ID")}}';
		var newUrl = url.replace("ID",id);
		var status = $('#status-id-' + id).text().trim();
		if (status === 'Active') {
			$.ajax({
				url: newUrl,
				type: 'PUT',
				data: {
					isFeatured: value
				},
				dataType: 'json',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(response) {
					if (response.status === true) {
						console.log('is_featured updated successfully');
					} else {
						console.log('Failed to update is_featured');
					}
				},
				error: function(xhr, status, error) {
					console.error('Error updating is_featured :', error);
				}
			});
		}
		else
		{
			alert('You can only change is_featured when status is Active.');
			$('#featured-id-' + id).prop('checked', false);
		}

	}

	$(".btn-detail").click(function () {
		var clickedId = $(this).attr('id');
		var id = 'pro-' + clickedId.split('-')[2];
		$('#' + id).slideToggle("slow");
	});

	function deleteProduct(id)
	{
		var url = '{{route("products.delete","ID")}}';
		var newUrl = url.replace("ID",id);
		if(confirm("Are you sure you want to delete"))
		{
			$.ajax({
				url: newUrl,
				type: 'delete',
				data: {},
				dataType: 'json',
				headers: {
            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        		},
				success: function(response) {
					$("button[type=submit]").prop('disabled', false);
					if (response["status"] == true) {
						alert("product deleted successfully");
						window.location.href="{{route('products.index')}}";
					}
					else
					{
						alert("product not found");
						window.location.href="{{route('products.index')}}";
					}
				}
			});


		}
	}
</script>

@endsection