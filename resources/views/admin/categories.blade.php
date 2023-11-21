@extends('admin.layouts.app')
@section('title')
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<i class="bi bi-stickies"></i>
	</li>
	<li class="breadcrumb-item breadcrumb-active" aria-current="Categories">Categories</li>
</ol>
@endsection
@section('content')
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

	<!-- Content wrapper start -->
	<div class="content-wrapper">

		<!-- Row start -->
		<div class="row gx-3">
			<div class="col-sm-12 col-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">View</div>
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
									<tr>
										<td>
											<p>ID: #Max00763</p>
										</td>
										<td>
											<p>women</p>
										</td>
										<td>
											<p>women</p>
										</td>
										<td>
											<img src="pictures/display-products/children-model.jpg" class="flag-img-lg" alt="" />
										</td>
										<td>2022/01/25</td>
										<td>2022/01/25</td>
										<td>
											<span class="badge shade-green min-70">Active</span>
										</td>
										<td>
											<div class="actions">
												<a href="#" class="viewRow" data-bs-toggle="modal" data-bs-target="#viewRow">
													<i class="bi bi-list text-green"></i>
												</a>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option">
												</div>
											</div>
										</td>
									</tr>

								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!-- Row end -->

	</div>
	<!-- Content wrapper end -->

	<!-- App Footer start -->
	<div class="app-footer">
		<span>© Private 2023</span>
	</div>
	<!-- App footer end -->

</div>

<!-- Modal View Row -->
<div class="modal modal-dark fade" id="viewRow" tabindex="-1" aria-labelledby="viewRowLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewRowLabel">View Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<!-- Row start -->
				<div class="row gx-3">
					<div class="col-lg-4 col-sm-6 col-6">
						<div class="customer-card">
							<h6>Customer Name</h6>
							<h5>Garrett Winters</h5>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-6">
						<div class="customer-card">
							<h6>Customer ID</h6>
							<h5>#Max00763</h5>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-6">
						<div class="customer-card">
							<h6>Contact</h6>
							<h5>067-676-98320</h5>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-6">
						<div class="customer-card">
							<h6>Amount Spent</h6>
							<h5>$2570.00</h5>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-6">
						<div class="customer-card">
							<h6>Last Login</h6>
							<h5>21/11/2021</h5>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-6">
						<div class="customer-card">
							<h6>Coupons Used</h6>
							<h5>7</h5>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-6">
						<div class="customer-card">
							<h6>Total Orders</h6>
							<h5>95</h5>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-6">
						<div class="customer-card">
							<h6>Cancelled Orders</h6>
							<h5>2</h5>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-6">
						<div class="customer-card">
							<h6>Reviews</h6>
							<h5>21</h5>
						</div>
					</div>
				</div>
				<!-- Row end -->

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection