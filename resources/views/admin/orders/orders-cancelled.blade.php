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
        <li class="breadcrumb-item breadcrumb-active" aria-current="Order Pending">Order news</li>
    </ol>
@endsection

@section('search-content')
    <form action="" method="get">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" value="{{ Request::get('keyword') }}"
                placeholder="Search">
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
                            <button onclick="window.location.href='{{ route('orders.news') }}'"
                                style="margin-left: 32px; border: 1px solid; padding: 0px 10px; font-size: 16px; border-radius: 12px;">refesh</button>
                        </div>
                        <div>s
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table v-middle m-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Gender</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Payment Method</th>
                                        <th>VNPAY Code</th>
                                        <th>Amount</th>
                                        <th>User ID</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr data-order-id="{{ $order->id }}">
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->code }}</td>
                                            <td>{{ $order->gender }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->pay_method }}</td>
                                            <td>{{ $order->VNPAYCODE }}</td>
                                            <td>{{ $order->amount }}</td>
                                            <td>{{ $order->userId }}</td>
                                            <td>
                                                <select name="status" class="status-select">
                                                    <option value="Pending Confirmation" {{ $order->status == 'Pending Confirmation' ? 'selected' : '' }}>Pending Confirmation</option>
                                                    <option value="Confirmed" {{ $order->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                    <option value="In Transit" {{ $order->status == 'In Transit' ? 'selected' : '' }}>In Transit</option>
                                                    <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </td>       
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page Navigation" style="margin-top: 40px">
                                {{ $orders->links() }}

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
    <div class="modal fade" id="image-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editVariantLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span></button>
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
        $(document).ready(function() {
            $('.status-select').change(function() {
                var orderId = $(this).closest('tr').data('order-id');
                var newStatus = $(this).val();

                $.ajax({
                    url: '/Orders/update-order-status/' + orderId,
                    type: 'PUT',
                    data: {
                        status: newStatus
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Status updated successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating status:', error);
                    }
                });
            });
        });
    </script>
@endsection
