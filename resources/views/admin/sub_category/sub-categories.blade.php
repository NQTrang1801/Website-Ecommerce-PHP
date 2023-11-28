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
	<li class="breadcrumb-item breadcrumb-active" aria-current="Sub-Categories">Sub Categories</li>
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
							<a href="{{route('sub-categories.create')}}">
								<button type="button" class="w-40 btn btn-success btn-rounded" style="color: black;">New Sub Category</button>
							</a>
						</div>

					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table v-middle m-0">
								<thead>
									<tr>
										<th>ID</th>
										<th>Sub Categories Name</th>
										<th>Slug</th>
										<th>Image</th>
										<th>Category ID</th>
										<th>Create At</th>
										<th>Update At</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@if ($subCategories->isNotEmpty())
										@foreach ($subCategories as $subCategory)
										<tr>
											<td>
												<p>{{$subCategory->id}}</p>
											</td>
											<td>
												<p>{{$subCategory->name}}</p>
											</td>
											<td>
												<p>{{$subCategory->slug}}</p>
											</td>
											<td>
												<img src="uploads/sub category/thumb/{{$subCategory->image}}" class="flag-img-lg" alt="" />
											</td>
											<td>{{$subCategory->category_id}}</td>
											<td>{{$subCategory->created_at}}</td>
											<td>{{$subCategory->updated_at}}</td>
											<td>
												@if($subCategory->status == 1)
													<span class="badge shade-green min-70">Active</span>
												@else
													<span class="badge shade-red min-70">block</span>
												@endif
											</td>
											<td>
												<div class="actions">
													<div class="icon">
														<a href="{{ route('sub-categories.edit',$subCategory->id)}}"><i class="bi bi-pencil-square"></i></a>
													</div>
													<div class="icon">
														<a href="#" onclick = "deleteSubCategory({{$subCategory->id}})"><i class="bi bi-x-square" style="color: red"></i></a>
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
								{{ $subCategories->links()}}
								
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
	function deleteSubCategory(id)
	{
		var url = '{{route("sub-categories.delete","ID")}}';
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
						alert("sub Category deleted successfully");
						window.location.href="{{route('sub-categories.index')}}";
					}
					else
					{
						alert("sub Category not found");
						window.location.href="{{route('sub-categories.index')}}";
					}
				}
			});


		}
	}

</script>

@endsection