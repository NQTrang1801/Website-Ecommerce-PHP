@extends('admin.layouts.app')

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
								<button type="button" class="w-40 btn btn-success btn-rounded" style="color: black;">Insert</button>
							</a>
							<a href="">
								<button type="button" class="w-40 btn btn-warning btn-rounded" style="color: black;">Update</button>
							</a>
							<button type="button" class="w-40 btn btn-danger btn-rounded" style="color: black;">Delete</button>
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
										<th>Create At</th>
										<th>Update At</th>
										<th>Status</th>
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
												<img src="uploads/category/thumb/{{$category->image}}" class="flag-img-lg" alt="" />
											</td>
											<td>{{$category->created_at}}</td>
											<td>{{$category->updated_at}}</td>
											<td>
												@if($category->status == 1)
													<span class="badge shade-green min-70">Active</span>
												@else
													<span class="badge shade-red min-70">block</span>
												@endif
											</td>
											<td>
												<div class="actions">
													<div class="form-check form-check-inline">
														<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option">
													</div>
												</div>
											</td>
										</tr>
										@endforeach
									@else
										<tr>
											<td colspan="8">Records not found</td>
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