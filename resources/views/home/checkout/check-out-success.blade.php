@extends('layouts.app-home')

@section('styles')
    <base href="/public">
    <link rel="stylesheet" href="home/styles/pages/checkout.css">
    <link href="assets/vnpay/jumbotron-narrow.css" rel="stylesheet">
    <script src="assets/vnpay_php/jquery-1.11.3.min.js"></script>
    <style>

    </style>
@endsection

@section('content')

    <body>
        <div class="container-2">
            <div class="header clearfix text-center">
                <h3 class="mt-3 font-weight-bold">Thông tin đơn hàng</h3>
            </div>
            <div class="clearfix text-center">
                <div class="form-group">
                    <label>Mã đơn hàng:</label>
                    <label><?php echo $_GET['vnp_TxnRef']; ?></label>
                </div>
                <div class="form-group">
                    <label>Số tiền:</label>
                    <label><?= number_format($_GET['vnp_Amount'] / 100) ?> VNĐ</label>
                </div>
                <div class="form-group">
                    <label>Nội dung thanh toán:</label>
                    <label><?php echo $_GET['vnp_OrderInfo']; ?></label>
                </div>
                <div class="form-group">
                    <label>Mã phản hồi (vnp_ResponseCode):</label>
                    <label><?php echo $_GET['vnp_ResponseCode']; ?></label>
                </div>
                <div class="form-group">
                    <label>Mã GD Tại VNPAY:</label>
                    <label><?php echo $_GET['vnp_TransactionNo']; ?></label>
                </div>
                <div class="form-group">
                    <label>Mã Ngân hàng:</label>
                    <label><?php echo $_GET['vnp_BankCode']; ?></label>
                </div>
                <div class="form-group">
                    <label>Thời gian thanh toán:</label>
                    <label><?php echo $_GET['vnp_PayDate']; ?></label>
                </div>
            </div>
        </div>

    </body>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "{{ route('updateVnpayCode') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    vnp_TxnRef: "{{ $_GET['vnp_TxnRef'] }}",
                    code: "{{ $_GET['vnp_TransactionNo'] }}"
                },
                success: function(response) {
                    console.log("VNPAYCODE đã được cập nhật thành công");
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi khi cập nhật VNPAYCODE: " + error);
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('AddOrderDetails') }}",
                contentType: 'application/json',
                data: JSON.stringify({
                    code: "{{ $_GET['vnp_TxnRef'] }}",
                    cart: cart
                }),
                success: function(response) {
                    console.log('success!');
                },
                error: function(xhr, status, error) {
                    console.error('Có lỗi xảy ra khi gửi dữ liệu:', error);
                }
            });

            localStorage.removeItem('cart');
        });
    </script>
@endsection
