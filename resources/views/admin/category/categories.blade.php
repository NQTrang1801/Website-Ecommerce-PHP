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
	<li class="breadcrumb-item breadcrumb-active" aria-current="Categories">Categories</li>
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
							<button onclick="window.location.href='{{ route("categories.index")}}'" style="margin-left: 32px; border: 1px solid; padding: 0px 10px; font-size: 16px; border-radius: 12px;">refesh</button>
						</div>
						<div>
							<a href="{{route('categories.create')}}">
								<button type="button" class="w-40 btn btn-success btn-rounded" style="color: black;">New Category</button>
							</a>
						</div>

					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table v-middle m-0">
								<thead>
									<tr>
										<th>ID</th>
										<th>Categories Name</th>
										<th>Slug</th>
										<th>Image</th>
										<th>Update At</th>
										<th>Status</th>
										<th>ShowHome</th>
										<th>isFeatured</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@if ($categories->isNotEmpty())
										@foreach ($categories as $category)
										<tr>
											<td>
												<p>{{$category->id}}</p>
											</td>
											<td>
												<p>{{$category->name}}</p>
											</td>
											<td>
												<p>{{$category->slug}}</p>
											</td>
											<td>
												<img src="{{ file_exists(public_path('uploads/category/thumb/' . $category->image)) ? asset('uploads/category/thumb/' . $category->image) : asset('uploads/category/thumb/null.png') }}" class="flag-img-lg" alt="" />
											</td>
											<td>{{$category->updated_at}}</td>
											<td id="status-id-{{$category->id}}">
												@if($category->status == 1)
													<span class="badge shade-green min-70">Active</span>
												@else
													<span class="badge shade-red min-70">block</span>
												@endif
											</td>
											<td>
												<div class="actions">
													<div class="form-check form-switch">
														<input id="showHome-id-{{$category->id}}" class="form-check-input show-home-checkbox" type="checkbox" role="switch" data-category-id="{{$category->id}}" {{ $category->showHome == 'Yes' ? 'checked' : '' }}>
													</div>
												</div>
											</td>
											<td>
												<div class="actions">
													<div class="form-check form-switch">
														<input id="featured-id-{{$category->id}}" class="form-check-input featured-checkbox" type="checkbox" role="switch" data-category-id="{{$category->id}}" {{ $category->is_featured == 1 ? 'checked' : '' }}>
													</div>
												</div>
											</td>
											<td>
												<div class="actions">
													<div class="icon">
														<a href="{{ route('categories.edit',$category->id)}}"><i class="bi bi-pencil-square"></i></a>
													</div>
													<div class="icon">
														<a href="#" onclick = "deleteCategory({{$category->id}})"><i class="bi bi-x-square" style="color: red"></i></a>
													</div>
												</div>
											</td>
										</tr>
										@endforeach
									@else
										<tr>
											<td colspan="9">Records not found</td>
										</tr>
									@endif

								</tbody>
							</table>
							<nav aria-label="Page Navigation" style="margin-top: 40px">
								{{ $categories->links()}}
								
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

	document.querySelectorAll('.show-home-checkbox')
		.forEach(function(checkbox) {
    		checkbox.addEventListener('change', function() {
				var categoryId = this.dataset.categoryId;
				var value = this.checked ? 'Yes' : 'No';
    			handleToggleShowHome(categoryId, value);
			});
		});

	function handleToggleShowHome(id, value) {
		var url = '{{route("categories.showHome","ID")}}';
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
				var categoryId = this.dataset.categoryId;
				var value = this.checked ? 1 : 0;
    			handleToggleFeatured(categoryId, value);
			});
		});

	function handleToggleFeatured(id, value) {
		var url = '{{route("categories.isFeatured","ID")}}';
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

	function deleteCategory(id)
	{
		var url = '{{route("categories.delete","ID")}}';
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
						alert("Category deleted successfully");
						window.location.href="{{route('categories.index')}}";
					}
					else
					{
						alert("Category not found");
						window.location.href="{{route('categories.index')}}";
					}
				}
			});


		}
	}

</script>

@endsection