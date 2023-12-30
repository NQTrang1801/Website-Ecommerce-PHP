<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
class PaymentController extends Controller
{
    public function vnpay_payment(Request $request)
    {
        $order = new Order();
        $order->code = $order->id.time();
        $order->gender = $request->gender;
        $order->name =  $request->name;
        $order->phone =  $request->phone;
        $order->address =  $request->address;
        $order->requirements =  $request->require;
        $order->printInvoice =  $request->printInvoice;
        $order->pay_method = "VNPAY";
        $order->amount = $request->amount;
        $order->userId = $request->userId;
        $order->status = "Pending Confirmation";
        $order->save();
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/checkout-success";
        $vnp_TmnCode = "8GAJ0VLV"; 
        $vnp_HashSecret = "VPLVZQYABKOJSGNRABUYFCGHADJBWUYI";

        $vnp_TxnRef = $order->code;
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "Private Shop";
        $vnp_Amount = $request->input('amount')*100; 
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $request->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if ($vnp_BankCode !== "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $hashdata = http_build_query($inputData);
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        $vnp_Url .= '?' . $hashdata . '&vnp_SecureHash=' . $vnpSecureHash;

        $returnData = [
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        ];

        if ($request->has('redirect')) {
            return redirect($vnp_Url);
        } else {
            return response()->json($returnData);
        }
    }

    public function updateVnpayCode(Request $request) {
        $vnp_TxnRef = $request->vnp_TxnRef;
        $order = Order::where('code', $vnp_TxnRef)->first();
        if ($order) {
            $order->VNPAYCODE = $request->code;
            $order->save();
        }
        return response()->json(['message' => 'VNPAYCODE đã được cập nhật']);
    }

    public function AddOrderDetails(Request $request) {
        $cart = $request->cart;
        $code = $request->code;
        $order = Order::where('code', $code)->first();
        foreach ($cart as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->variant_id = $item['id'];
            $orderDetail->quantity = $item['QuantityPurchased'];
            $orderDetail->price = $item['price'];
            $orderDetail->promotion_id = $item['promotion_id'];
            $orderDetail->save();
        }
    
        return response()->json(['message' => 'Thêm OrderDetails thành công']);
    }
    
    
    
}
